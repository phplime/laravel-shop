<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\LanguageData;
use Illuminate\Contracts\Translation\Loader;

class DatabaseLoader implements Loader
{
    protected $hints = [];

    public function load($locale, $group, $namespace = null): array
    {
        // Normalize locale (column name)
        $locale = str($locale)->slug('_');

        // Check if the column exists
        if (!Schema::hasColumn('language_data', $locale)) {
            return []; // column does not exist
        }

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
