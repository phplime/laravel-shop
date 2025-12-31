<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class UserAccessService
{
    public function getUserAccessData(string|int $username): array
    {
        $identifier = is_numeric($username) ? 'id' : 'username';
        $user = User::with('package')
            ->where($identifier, $username)
            ->firstOrFail();

        $userId = $user->id;

        // Vendor
        $vendor = Vendor::where('user_id', $userId)->first();

        // Subscribe features (single query)
        $subscribeFeatures = DB::table('subscribe_features')
            ->where('user_id', $userId)
            ->get()
            ->keyBy('feature_id');

        // Subscribed order types (single query)
        $subscribeOrderTypes = DB::table('subscribed_order_types')
            ->where('user_id', $userId)
            ->get()
            ->keyBy('order_type_id');

        // Package features from active_package_features (based on user's current package)
        $packageFeatures = [];
        if ($user->package_id) {
            $packageFeatures = DB::table('active_package_features')
                ->where('package_id', $user->package_id)
                ->where('status', 1)
                ->pluck('feature_id')
                ->toArray();
        }

        return [
            'user'     => $user,
            'vendor'   => $vendor,

            // Global lists
            'features'    => DB::table('feature_list')->get(),
            'order_types' => DB::table('order_type_list')->get(),
            'payment_gateways' => DB::table('payment_gateway_list')
                ->where('status', 1)
                ->get(),

            // User feature access (Admin toggles)
            'user_features' => $subscribeFeatures
                ->pluck('status', 'feature_id')
                ->toArray(),

            // Package features (The "Package" badge)
            'package_features' => array_fill_keys($packageFeatures, 1),

            // User order type access
            'user_order_types' => $subscribeOrderTypes
                ->pluck('is_admin_enable', 'order_type_id')
                ->toArray(),

            'package_order_types' => $subscribeOrderTypes
                ->pluck('is_package', 'order_type_id')
                ->toArray(),

            // Payments
            'user_payments' => DB::table('vendor_payment_list')
                ->where('user_id', $userId)
                ->pluck('is_admin_enabled', 'slug')
                ->toArray(),
        ];
    }
    /**
     * Get all access-related data for a user to manage in admin
     */
    public function getUserAccessData__(string $username): array
    {
        $user = User::where('username', $username)->with('package')->firstOrFail();
        $userId = $user->id;
        $vendor = Vendor::where('user_id', $userId)->first();

        return [
            'user'             => $user,
            'vendor'           => $vendor,
            'features'         => DB::table('feature_list')->get(),
            'user_features'    => DB::table('subscribe_features')
                ->where('user_id', $userId)
                ->pluck('status', 'feature_id')
                ->toArray(),
            'package_features' => DB::table('subscribe_features')
                ->where('user_id', $userId)
                ->pluck('is_package', 'feature_id')
                ->toArray(),
            'order_types'      => DB::table('order_type_list')->get(),
            'user_order_types' => DB::table('subscribed_order_types')
                ->where('user_id', $userId)
                ->pluck('is_admin_enable', 'order_type_id')
                ->toArray(),
            'package_order_types' => DB::table('subscribed_order_types')
                ->where('user_id', $userId)
                ->pluck('is_package', 'order_type_id')
                ->toArray(),
            'payment_gateways' => DB::table('payment_gateway_list')->where('status', 1)->get(),
            'user_payments'    => DB::table('vendor_payment_list')
                ->where('user_id', $userId)
                ->pluck('is_admin_enabled', 'slug')
                ->toArray(),
        ];
    }

    /**
     * Update access for a specific type
     */
    public function updateAccess(int $userId, string $type, $id, int $status): bool
    {
        return match ($type) {
            'feature'    => DB::table('subscribe_features')
                ->where('user_id', $userId)
                ->where('feature_id', $id)
                ->update(['status' => $status]),
            'order_type' => DB::table('subscribed_order_types')
                ->where('user_id', $userId)
                ->where('order_type_id', $id)
                ->update(['is_admin_enable' => $status]),
            'payment'    => DB::table('vendor_payment_list')
                ->where('user_id', $userId)
                ->where('slug', $id)
                ->update(['is_admin_enabled' => $status]),
            default      => false,
        };
    }
}
