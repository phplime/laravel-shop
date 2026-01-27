<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Repositories\MediaFileRepository;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Cache;

class MediaFileService
{
    protected $repo;
    protected $imageManager;

    public function __construct(MediaFileRepository $repo)
    {
        $this->repo = $repo;
        $this->imageManager = new ImageManager(new Driver());
    }

    public function getFiles(array $filters)
    {
        $role = $filters['role'] ?? 'admin';
        $vendorId = $filters['vendorId'] ?? 0;
        $versionKey = "media_cache_version_{$role}_{$vendorId}";

        $version = Cache::get($versionKey, 1);
        $cacheKey = "media_files_v{$version}_" . md5(json_encode($filters));

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($filters) {
            $perPage = $filters['per_page'] ?? 10;
            $recent = $this->repo->getRecentFiles($filters, 3);
            $excludeIds = $recent->pluck('id')->toArray();
            $old = $this->repo->getOldFiles($filters, $excludeIds, $perPage);

            return [
                'recent' => $recent,
                'old'    => $old,
            ];
        });
    }

    public function handleUpload(Request $request, $userId, $vendorId, $role)
    {
        // Validate the request
        $validator = validator($request->all(), [
            'file' => 'required|array',
            'file.*' => 'file|max:10240', // 10MB max per file
        ]);

        if ($validator->fails()) {
            return [
                'response' => [
                    'st' => 0,
                    'data' => $validator->errors()->first()
                ],
                'status' => 400
            ];
        }

        if (!$request->hasFile('file')) {
            return [
                'response' => [
                    'st' => 0,
                    'data' => 'Please select an image'
                ],
                'status' => 400
            ];
        }

        try {
            $files = $request->file('file');
            $uploadPath = $role === 'admin' ? 'uploads' : 'uploads/vendor';
            $uploadData = [];

            foreach ($files as $file) {
                $fileData = $this->processFile($file, $uploadPath, $userId, $vendorId, $role);
                if ($fileData) {
                    $uploadData[] = $fileData;
                }
            }


            if (empty($uploadData)) {
                return [
                    'response' => [
                        'st' => 0,
                        'data' => 'Upload failed'
                    ],
                    'status' => 400
                ];
            }

            // Save to database and get IDs
            $insertedIds = $this->repo->save($uploadData);

            // Increment media cache version to "refresh" the library
            $versionKey = "media_cache_version_{$role}_{$vendorId}";
            Cache::increment($versionKey);

            return [
                'response' => [
                    'st' => 1,
                    'data' => $uploadData,
                    'ids' => $insertedIds
                ],
                'status' => 201
            ];
        } catch (Exception $e) {
            return [
                'response' => [
                    'st' => 0,
                    'data' => ['error' => 'Upload failed: ' . $e->getMessage()]
                ],
                'status' => 500
            ];
        }
    }

    protected function processFile($file, $uploadPath, $userId, $vendorId, $role)
    {
        try {
            // Sanitize original filename
            $originalName = str_replace(',', '_', $file->getClientOriginalName());

            // Generate UUID filename
            $extension = $file->getClientOriginalExtension();
            $isImage = str_starts_with($file->getMimeType(), 'image/');
            $filename = Str::uuid()->toString() . ($isImage ? '.webp' : '.' . $extension);
            $fullPath = "{$uploadPath}/{$filename}";

            $thumbPath = null;

            if ($isImage) {
                // Process main image
                $image = $this->imageManager->read($file)
                    ->scaleDown(width: 1600)
                    ->encode(new WebpEncoder(quality: 80));

                Storage::disk('public')->put($fullPath, (string) $image);

                // Generate thumbnail
                $thumbName = 'thumb_' . $filename;
                $thumbFullPath = "{$uploadPath}/{$thumbName}";
                $thumb = $this->imageManager->read($file)
                    ->scaleDown(width: 400)
                    ->encode(new WebpEncoder(quality: 80));
                Storage::disk('public')->put($thumbFullPath, (string) $thumb);

                $thumbPath = $thumbFullPath;
            } else {
                Storage::disk('public')->putFileAs($uploadPath, $file, $filename);
            }

            return [
                'images' => 'storage/' . $fullPath,
                'thumb' => $thumbPath ? 'storage/' . $thumbPath : null,
                'title' => $originalName,
                'user_id' => $userId,
                'vendor_id' => $vendorId,
                'role' => $role,
                'created_at' => now(),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function upload(array $data)
    {
        $file   = $data['file'];
        $table  = $data['table'] ?? null;
        $id     = $data['id'] ?? null;
        $path   = $data['path'] ?? 'uploads';


        $extension = $file->getClientOriginalExtension();
        $isImage = str_starts_with($file->getMimeType(), 'image/');
        $filename  = Str::uuid()->toString() . ($isImage ? '.webp' : '.' . $extension);
        $fullPath  = "{$path}/{$filename}";

        if ($isImage) {
            // Process main image
            $image = $this->imageManager->read($file)
                ->scaleDown(width: 1600)
                ->encode(new WebpEncoder(quality: 80));

            Storage::disk('public')->put($fullPath, (string) $image);

            // Generate thumbnail
            $thumbName = 'thumb_' . $filename;
            $thumbPath = "{$path}/{$thumbName}";
            $thumb = $this->imageManager->read($file)
                ->scaleDown(width: 400)
                ->encode(new WebpEncoder(quality: 80));
            Storage::disk('public')->put($thumbPath, (string) $thumb);
        } else {
            Storage::disk('public')->putFileAs($path, $file, $filename);
            $thumbPath = null;
        }

        $mediaData = [
            'images'  => $fullPath . '/' . $filename,
            'thumb' => $thumbPath . '/' . $filename ?? null,
        ];

        return $this->repo->save($mediaData);
    }

    public function delete($id)
    {
        try {
            $media = $this->repo->findById($id);

            if (!$media) {
                return false;
            }

            // Delete physical files
            $imagePath = str_replace('storage/', '', $media->images);
            $thumbPath = str_replace('storage/', '', $media->thumb);

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            if ($thumbPath && Storage::disk('public')->exists($thumbPath)) {
                Storage::disk('public')->delete($thumbPath);
            }

            // Delete database record
            $deleted = $this->repo->delete($id);

            if ($deleted) {
                $versionKey = "media_cache_version_{$media->role}_{$media->vendor_id}";
                Cache::increment($versionKey);
                Cache::forget("media_file_{$id}");
            }

            return $deleted;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function getSelectedMediaFiles($request)
    {
        return $this->repo->getSelectedMediaFiles($request);
    }
}
