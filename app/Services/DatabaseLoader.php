<?php

namespace App\Services;

use Illuminate\Contracts\Translation\Loader;
use App\Models\LanguageData;

class DatabaseLoader implements Loader
{
    protected $hints = [];

    public function load($locale, $group, $namespace = null): array
    {
        // JSON lines: __('Hello')
        if ($group === '*' && $namespace === '*') {
            return LanguageData::where('locale', $locale)
                ->whereRaw('`key` NOT LIKE "%.%"') // keys without dots
                ->pluck('value', 'key')
                ->toArray();
        }

        // Grouped translations: __('messages.welcome')
        if ($namespace === '*' || $namespace === null) {
            return LanguageData::where('locale', $locale)
                ->where('key', 'like', $group . '.%')
                ->get()
                ->mapWithKeys(function ($item) use ($group) {
                    $key = substr($item->key, strlen($group) + 1);
                    return [$key => $item->value];
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
