<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    /**
     * Check if a setting key exists
     */
    public function exists(string $key): bool
    {
        return Setting::where('key', $key)->exists();
    }


    /**
     * Get setting value by key
     */
    public function get(string $key, $default = '')
    {
        return Setting::where('key', $key)->value('value') ?? $default;
    }


    /**
     * Update existing key
     */
    public function update(string $key, array $data)
    {
        return Setting::where('key', $key)->update($data);
    }


    /**
     * Insert new key
     */
    public function insert(array $data)
    {
        return Setting::create($data);
    }


    /**
     * Main function like __check() from CI
     * Inserts or updates multiple settings
     */
    public function saveMany(array $data, $useRaw = false)
    {
        foreach ($data as $key => $value) {

            $exists = $this->exists($key);

            $payload = ['key' => $key, 'value' => $value];

            if ($exists) {
                // update
                Setting::where('key', $key)->update($payload);
            } else {
                // insert
                Setting::create($payload);
            }
        }

        return true;
    }
}
