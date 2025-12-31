<?php

namespace App\Services;

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SettingsService
{
    protected $cacheKey = 'admin_settings';
    protected static $settingsCache = null;

    /**
     * Get all settings (cached)
     */
    public function all(): array
    {
        if (self::$settingsCache !== null) {
            return self::$settingsCache;
        }

        self::$settingsCache = Cache::rememberForever($this->cacheKey, function () {
            return Settings::pluck('value', 'key')->toArray();
        });

        return self::$settingsCache;
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
        self::$settingsCache = $settings;
    }

    public function cacheAllSettingsAgain($key = null): void
    {
        $key = !empty($key) ? $key : $this->cacheKey;
        Cache::forget($key);
        $settings = Settings::pluck('value', 'key')->toArray();
        Cache::forever($key, $settings);

        if ($key === $this->cacheKey) {
            self::$settingsCache = $settings;
        }
    }

    /**
     * Update a specific setting in the cache
     */
    public function updateCacheValue(string $key, $value): void
    {
        // Get the current cached settings
        $settings = Cache::get($this->cacheKey, []);

        // Update the specific setting
        $settings[$key] = $value;

        // Put the updated settings back in the cache
        Cache::forever($this->cacheKey, $settings);
        self::$settingsCache = $settings;
    }




    public function mailConfig()
    {
        $config = $this->smtp_config();

        $email = $this->get('smtp_mail');
        $mail_type = $this->get('mail_type', 'smtp');

        if (!$config) {
            return config('mail.default');
        }

        $mailerName = $mail_type == 'smtp' ? 'admin_smtp' : 'admin_sendgrid';

        if ($mail_type == 'smtp') {
            Config::set("mail.mailers.$mailerName", [
                'transport'  => 'smtp',
                'host'       => $config->smtp_host ?? '',
                'port'       => $config->smtp_port ?? 587,
                'encryption' => 'tls',
                'username'   => $email,
                'password'   => $config->smtp_password ?? '',
                'timeout'    => null,
            ]);
        } else {
            Config::set("mail.mailers.$mailerName", [
                'transport'  => 'sendgrid',
                'sendgrid_api_key'   => $config->sendgrid_api_key ?? '',
                'timeout'    => null,
            ]);
        }

        Config::set("mail.from.address", $email ?? config('mail.from.address'));
        Config::set("mail.from.name", config('app.name'));

        return $mailerName;
    }

    public function smtp_config()
    {
        $settingsValue = $this->get('smtp_config');
        $config =  !empty($settingsValue) && isJson($settingsValue) ? json_decode($settingsValue) : null;

        return $config;
    }
}
