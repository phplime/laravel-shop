<?php
 
namespace App\Services;
 
use App\Models\VendorSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
 
class VendorSettingsService
{
    protected static $settingsCache = [];
 
    /**
     * Get all settings for a specific vendor (cached)
     */
    public function all(?int $vendorId = null): array
    {
        $vendorId = $vendorId ?? _ID();
        
        if ($vendorId <= 0) {
            return [];
        }
 
        if (isset(self::$settingsCache[$vendorId])) {
            return self::$settingsCache[$vendorId];
        }
 
        $cacheKey = "vendor_settings_{$vendorId}";
 
        self::$settingsCache[$vendorId] = Cache::remember($cacheKey, 86400, function () use ($vendorId) {
            return VendorSetting::where('vendor_id', $vendorId)
                ->pluck('value', 'key')
                ->toArray();
        });
 
        return self::$settingsCache[$vendorId];
    }
 
    /**
     * Get single setting for a vendor
     */
    public function get(string $key, $default = '', ?int $vendorId = null)
    {
        $settings = $this->all($vendorId);
        return $settings[$key] ?? $default;
    }
 
    /**
     * Save/Update settings for a vendor
     */
    public function save(array $data, ?int $vendorId = null): bool
    {
        $vendorId = $vendorId ?? _ID();
        $userId = Auth::id();
 
        if ($vendorId <= 0) {
            return false;
        }
 
        foreach ($data as $key => $value) {
            VendorSetting::updateOrCreate(
                ['vendor_id' => $vendorId, 'key' => $key],
                ['value' => $value, 'user_id' => $userId]
            );
        }
 
        $this->clearCache($vendorId);
        return true;
    }
 
    /**
     * Clear cache for a vendor
     */
    public function clearCache(int $vendorId): void
    {
        Cache::forget("vendor_settings_{$vendorId}");
        unset(self::$settingsCache[$vendorId]);
    }
}
