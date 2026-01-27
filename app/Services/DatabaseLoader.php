<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\LanguageData;
use Illuminate\Contracts\Translation\Loader;

class DatabaseLoader implements Loader
{
    protected $hints = [];
    protected $cacheEnabled;
    protected $cacheDuration;

    public function __construct()
    {
        $this->cacheEnabled = config('app.translation_cache_enabled', false);
        $this->cacheDuration = config('app.translation_cache_duration', 3600);
    }

    public function load($locale, $group, $namespace = null): array
    {
        // Normalize locale (column name)
        $locale = str($locale)->slug('_');

        // Check if the column exists
        if (!Schema::hasColumn('language_data', $locale)) {
            return []; // column does not exist
        }

        $cacheKey = "translations_{$locale}_{$group}_{$namespace}";

        // If cache is disabled, fetch directly without caching
        if (!$this->cacheEnabled) {
            return $this->fetchTranslations($locale, $group, $namespace);
        }

        // Otherwise, use cache
        return \Illuminate\Support\Facades\Cache::remember($cacheKey, $this->cacheDuration, function () use ($locale, $group, $namespace) {
            return $this->fetchTranslations($locale, $group, $namespace);
        });
    }

    /**
     * Fetch translations from database
     */
    protected function fetchTranslations($locale, $group, $namespace): array
    {
        // JSON-like translations (__('Hello')) → keys without dot
        if ($group === '*' && $namespace === '*') {
            return DB::table('language_data')
                ->select('keyword', $locale)
                ->whereRaw('`keyword` NOT LIKE "%.%"') // keywords without dots
                ->get()
                ->pluck($locale, 'keyword')
                ->toArray();
        }

        // Grouped translations (__('messages.welcome')) → keys with dot
        if ($namespace === '*' || $namespace === null) {
            return DB::table('language_data')
                ->select('keyword', $locale)
                ->where('keyword', 'like', $group . '.%')
                ->get()
                ->mapWithKeys(function ($item) use ($group, $locale) {
                    $keyword = substr($item->keyword, strlen($group) + 1); // remove group prefix
                    return [$keyword => $item->$locale]; // fetch from column
                })
                ->toArray();
        }

        return [];
    }

    /**
     * Enable or disable cache at runtime
     */
    public function setCacheEnabled(bool $enabled): void
    {
        $this->cacheEnabled = $enabled;
    }

    /**
     * Check if cache is enabled
     */
    public function isCacheEnabled(): bool
    {
        return $this->cacheEnabled;
    }

    public function addNamespace($namespace, $hint): void
    {
        $this->hints[$namespace] = $hint;
    }

    public function addJsonPath($path): void
    {
        // Not used in DB loader
    }

    public function namespaces(): array
    {
        return $this->hints;
    }
}
