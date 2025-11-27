<?php

namespace App\Services;

use App\Models\Settings;    
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    protected $cacheKey = 'admin_settings';

    /**
     * Get all settings (cached)
     */
    public function all(): array
    {
        return Cache::rememberForever($this->cacheKey, function () {
            return Settings::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get single setting
     */
    public function get(string $key, $default = '')
    {
        $settings = $this->all();
        return $settings[$key] ?? $default;
    }

    /**
     * Insert or update many settings (CI: __check)
     */
    public function saveMany(array $data): bool
    {
        foreach ($data as $key => $value) {
            Settings::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // CI behavior: After saving → Rebuild cache
        $this->rebuildCache();

        return true;
    }

    /**
     * Check if a setting key exists
     */
    public function exists(string $key): bool
    {
        $settings = $this->all();
        return array_key_exists($key, $settings);
    }

    /**
     * Rebuild cache manually (CI: __updateCache)
     */
    public function rebuildCache(): void
    {
        $settings = Settings::pluck('value', 'key')->toArray();
        Cache::forever($this->cacheKey, $settings);
    }
}
