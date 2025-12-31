<?php

namespace App\Services;

use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use user;

class ModuleAccessService
{
    public function has(
        string $type,
        string $slug,
        ?int $vendorId = null,
        string $userType = 'vendor_id'
    ): bool {
        // Resolve vendor & user
        [$vendorId, $userId] = $this->resolveVendorAndUser($vendorId, $userType);

        if (!$vendorId) {
            return false;
        }

        // Get module
        $moduleId = Vendor::where('id', $vendorId)->value('module_id');

        if (!$moduleId) {
            return false;
        }

        // Fetch module details once
        $module = $this->getModuleDetails($moduleId);

        if (!$module) {
            return false;
        }

        return match ($type) {
            'features'         => $module->feature_list->contains('slug', $slug),
            'order_types'      => $module->order_types->contains('slug', $slug),
            'package_features' => $this->userHasFeature($userId, $slug),
            default            => false,
        };
    }

    /* -------------------------------- */
    /* Helpers                          */
    /* -------------------------------- */

    protected function resolveVendorAndUser(?int $id, string $type): array
    {
        if ($type === 'user_id') {
            $vendorId = Vendor::where('user_id', $id)->value('id');

            return [$vendorId, $id];
        }

        $vendorId = $id ?? user()?->vendor_id;

        $userId = Vendor::where('id', $vendorId)->value('user_id');

        return [$vendorId, $userId];
    }

    protected function existsInJson(?string $json, string $slug): bool
    {
        if (!$json || !isJson($json)) {
            return false;
        }

        foreach (json_decode($json) as $item) {
            if (($item->slug ?? null) === $slug) {
                return true;
            }
        }

        return false;
    }

    protected function userHasFeature(?int $userId, string $slug): bool
    {
        if (!$userId) {
            return false;
        }

        return DB::table('subscribe_features')
            ->join('feature_list', 'feature_list.id', '=', 'subscribe_features.feature_id')
            ->where('subscribe_features.user_id', $userId)
            ->where('subscribe_features.status', 1)
            ->where('subscribe_features.is_package', 1)
            ->where('feature_list.slug', $slug)
            ->exists();
    }

    public function getModuleDetails(string|int $moduleIdentifier)
    {
        // 1. Fetch module by slug or ID
        $query = DB::table('module_list');
        
        if (is_numeric($moduleIdentifier)) {
            $query->where('id', $moduleIdentifier);
        } else {
            $query->where('slug', $moduleIdentifier);
        }

        $module = $query->first();

        if (!$module) {
            return null;
        }

        // 2. Decode JSON safely
        $featureIds = [];
        if (!empty($module->feature_ids) && isJson($module->feature_ids)) {
            $featureIds = json_decode($module->feature_ids, true);
        }

        $orderTypeIds = [];
        if (!empty($module->order_type_ids) && isJson($module->order_type_ids)) {
            $orderTypeIds = json_decode($module->order_type_ids, true);
        }

        // 3. Fetch related data (only if needed)
        $module->feature_list = !empty($featureIds)
            ? DB::table('module_feature_list')
            ->whereIn('id', $featureIds)
            ->get()
            : collect();

        $module->order_types = !empty($orderTypeIds)
            ? DB::table('order_type_list')
            ->whereIn('id', $orderTypeIds)
            ->get()
            : collect();

        return $module;
    }
}
