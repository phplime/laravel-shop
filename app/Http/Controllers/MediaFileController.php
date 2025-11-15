<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use Illuminate\Http\Request;
use App\Services\MediaFileService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class MediaFileController extends Controller
{
    protected $mediaService;

    public function __construct(MediaFileService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 30);
        $page    = (int) $request->get('page', 1);

        $filters = [
            'per_page' => $perPage,
            'page'     => $page,
            // add other filters from $request if needed
        ];

        // Call service (correct)
        $mediaFiles = $this->mediaService->getFiles($filters);
        // $mediaFiles is expected to be: ['recent' => Collection/Paginator, 'old' => Collection/ Paginator]

        // Determine total for 'old'
        $totalOldFiles = $mediaFiles['old'] instanceof LengthAwarePaginator
            ? $mediaFiles['old']->total()
            : $mediaFiles['old']->count();

        // Wrap old in paginator if service returned a plain collection/array
        if (! $mediaFiles['old'] instanceof LengthAwarePaginator) {
            $mediaFiles['old'] = new LengthAwarePaginator(
                $mediaFiles['old'],
                $totalOldFiles,
                $perPage,
                $page,
                ['path' => url('admin/media/get-media')]
            );
        }

        // Render blade partials
        $fileListView = view('media_layouts.media_thumb', [
            'file_list'    => $mediaFiles['old'],
            'recent_files' => $mediaFiles['recent'],
            'link'         => $mediaFiles['old']->links()->toHtml(),
        ])->render();

        $recentView = view('media_layouts.recent_thumb', [
            'file_list'    => $mediaFiles['old'],
            'recent_files' => $mediaFiles['recent'],
        ])->render();

        return response()->json([
            'status'        => 200,
            'uploaded_data' => $fileListView,
            'recent_data'   => $recentView,
        ]);
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->get('id');

            if (!$id) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Media ID is required'
                ], 400);
            }

            $result = $this->mediaService->delete($id);

            if ($result) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Media deleted successfully'
                ]);
            }

            return response()->json([
                'status' => 404,
                'message' => 'Media not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete media: ' . $e->getMessage()
            ], 500);
        }
    }


    public function select(Request $request)
    {
        $selectedFile = $this->mediaService->getSelectedMediaFiles($request);

        $recentView = view('media_layouts.selected_files', [
            'file_list'    => $selectedFile,
        ])->render();

        return response()->json([
            'status'        => 200,
            'selected_files' => $recentView,
        ]);
    }


    /**
     * Display a listing of media files
     */
    public function index__(Request $request)
    {
        $filters = [
            'per_page' => $request->input('per_page', 10),
            'table_name' => $request->input('table_name'),
            // 'table_id' => $request->input('table_id'),
            // 'mime_type' => $request->input('mime_type'),
            'search' => $request->input('search'),
        ];

        $files = $this->mediaService->getFiles($filters);

        return response()->json([
            'success' => true,
            'recent' => $files['recent'],
            'old' => $files['old']
        ]);
    }

    public function upload(Request $request)
    {
        // Get parameters from request
        $userId = $request->input('user_id', 0);
        $vendorId = $request->input('vendor_id', 0);
        $role = $request->input('role', 'admin');

        // Handle OPTIONS request for CORS
        if ($request->isMethod('options')) {
            return response('', 200)
                ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT')
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        }

        $result = $this->mediaService->handleUpload($request, $userId, $vendorId, $role);

        return response()->json($result['response'], $result['status'])
            ->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * Upload multiple media files (Uppy compatible)
     */
    public function upload__(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|array',
            'file.*' => 'required|file|max:10240', // 10MB max per file
            'id' => 'nullable|integer',
            'path' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $uploadedFiles = [];
            $files = $request->file('file');

            foreach ($files as $file) {
                $data[] = [
                    'files' => $file,
                    'id' => $request->input('id'),
                    // 'path' => $request->input('path', 'uploads'),
                ];

                $uploadedFiles[] = $this->mediaService->upload($data);
            }
            // dd($data);
            return response()->json([
                'success' => true,
                'message' => count($uploadedFiles) . ' file(s) uploaded successfully',
                'data' => $uploadedFiles,
                'count' => count($uploadedFiles),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'File upload failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a media file
     */
    // public function destroy($id)
    // {
    //     try {

    //         if ($deleted) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'File deleted successfully',
    //             ]);
    //         }

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'File not found',
    //         ], 404);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'File deletion failed',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
