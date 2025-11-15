<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LanguageData extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'language_data';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    /**
     * Automatically clear cache for the locale
     * when translations are added, updated, or deleted.
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget("lang_{$model->locale}");
        });

        static::deleted(function ($model) {
            Cache::forget("lang_{$model->locale}");
        });
    }

    /**
     * Get translation by key and locale (with optional fallback).
     *
     * @param  string  $key
     * @param  string|null  $locale
     * @param  bool  $fallback
     * @return string|null
     */
    // public static function getValue(string $key, ?string $locale = null, bool $fallback = true): ?string
    // {
    //     $locale = $locale ?? app()->getLocale();

    //     $translations = Cache::rememberForever("lang_{$locale}", function () use ($locale) {
    //         return self::where('locale', $locale)->pluck('value', 'key')->toArray();
    //     });

    //     // Return translation or fallback to default locale if enabled
    //     if (isset($translations[$key])) {
    //         return $translations[$key];
    //     }

    //     if ($fallback && $locale !== config('app.locale')) {
    //         $fallbackTranslations = Cache::rememberForever("lang_" . config('app.locale'), function () {
    //             return self::where('locale', config('app.locale'))->pluck('value', 'key')->toArray();
    //         });

    //         return $fallbackTranslations[$key] ?? null;
    //     }

    //     return null;
    // }

    /**
     * Bulk refresh all cached translations (for admin panel or console command).
     */
    // public static function refreshAllCaches(): void
    // {
    //     $locales = self::distinct()->pluck('locale');
    //     foreach ($locales as $locale) {
    //         Cache::forget("lang_{$locale}");
    //         Cache::rememberForever("lang_{$locale}", function () use ($locale) {
    //             return self::where('locale', $locale)->pluck('value', 'key')->toArray();
    //         });
    //     }
    // }
}
