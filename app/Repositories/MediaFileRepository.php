<?php

namespace App\Repositories;

use App\Models\MediaFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaFileRepository
{
    /**
     * Build the base query with all common filters.
     */
    public function baseQuery(array $filters = [])
    {
        $query = DB::table('media_files as m')
            ->select(
                'm.*',
                'u.username as user_username',
                'u.name as user_name',
                // 'v.username as vendor_username',
                // 'v.app_name as vendor_name'
            )
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id');
        // ->leftJoin('vendor_list as v', 'v.id', '=', 'm.vendor_id');

        $role = $filters['role'] ?? 'admin';
        $vendorId = $filters['vendorId'] ?? 0;
        $userId = $filters['userId'] ?? 0;
        $search = $filters['search'] ?? '';

        // 🟢 Role-based filtering
        if ($role === 'admin') {
            $query->where('m.role', 'admin');
        } elseif ($role === 'vendor') {
            // Vendor sees their own or assigned uploads
            $query->where(function ($q) use ($vendorId, $userId) {
                $q->where('m.user_id', $userId)
                    ->orWhere('m.vendor_id', $vendorId);
            })->where('m.user_id', '!=', 0);
        } else {
            // For staff or custom roles
            $query->where('m.role', $role);
        }

        // 🔍 Search filter
        if (!empty($search)) {
            $query->where('m.title', 'like', "%{$search}%");
        }

        return $query;
    }

    /**
     * Get recent uploads (default: last 3)
     */
    public function getRecentFiles(array $filters, int $limit = 3)
    {
        return $this->baseQuery($filters)
            ->orderByDesc('m.created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get older files with pagination, excluding recent ones
     */
    public function getOldFiles(array $filters, array $excludeIds = [], int $perPage = 10)
    {
        return $this->baseQuery($filters)
            ->when(!empty($excludeIds), fn($q) => $q->whereNotIn('m.id', $excludeIds))
            ->orderByDesc('m.created_at')
            ->paginate($perPage);
    }

    public function save(array $data)
    {
        if (isset($data[0]) && is_array($data[0])) {
            $insertedIds = [];
            foreach ($data as $item) {
                $insertedIds[] = MediaFile::create($item)->id;
            }
            return $insertedIds;
        }

        // Single record
        return MediaFile::create($data)->id;
    }

    public function findById($id)
    {
        try {
            return MediaFile::find($id);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $mediaFile = $this->findById($id);

            if ($mediaFile) {
                return $mediaFile->delete();
            }

            return false;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getSelectedMediaFiles($request)
    {

        $query = DB::table('media_files as m')
            ->select('m.*', 'u.username', 'u.name');

        if ($request->vendorId && $request->vendorId != 0) {
            $query->addSelect('v.username as vendor_username', 'v.name as vendor_name');
            $query->leftJoin('vendor_list as v', 'v.id', '=', 'm.vendor_id');
            $query->where('m.vendor_id', $request->vendorId);
        }

        $query->leftJoin('users as u', 'u.id', '=', 'm.user_id');

        if ($request->has('ids')) {
            $query->whereIn('m.id', (array) $request->ids);
        }

        $query->orderBy('m.id', 'DESC');

        return $query->get();
    }
}
