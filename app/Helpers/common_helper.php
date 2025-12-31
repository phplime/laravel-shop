<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Services\SettingsService;

if (!function_exists('media_files')) {
    function media_files($name = 'image', $type = 'single', $value = '')
    {
        $selectedImages = collect();

        if (!empty($value)) {
            $ids = array_filter(array_map('trim', explode(',', $value)), 'is_numeric');
            if (!empty($ids)) {
                $selectedImages = \App\Models\MediaFile::whereIn('id', $ids)
                    ->orderBy('id', 'desc')
                    ->get();
            }
        }

        return view('media_layouts/upload_file', [
            'name' => $name,
            'type' => $type,
            'value' => $value,
            'isHide' => true,
            'selectedImages' => $selectedImages,
        ]);
    }
}


if (!function_exists('__check')) {

    function __check($data, $raw = false)
    {
        $service = app(SettingsService::class);

        if (is_array($data)) {
            return $service->saveMany($data, $raw);
        }

        return $service->exists($data);
    }
}

if (!function_exists('__settings')) {
    function __settings($key = null)
    {
        $service = app(SettingsService::class);
        $all = $service->all();

        if ($key === null) {
            return (object) $all;
        }

        return $all[$key] ?? '';
    }
}


if (!function_exists('__config')) {
    function __config($key)
    {
        if (Schema::hasTable('settings')) :
            return \App\Models\Settings::where('key', $key)->value('value');
        else :
            return [];
        endif;
    }
}

if (!function_exists('__updateCache')) {
    function __updateCache($key = null)
    {
        $service = app(SettingsService::class);
        $service->cacheAllSettingsAgain($key);
    }
}


if (!function_exists('__updateCacheValue')) {
    function __updateCacheValue($key = null, $value = null)
    {
        $service = app(SettingsService::class);
        $service->updateCacheValue($key, $value);
    }
}

if (!function_exists('country')) {

    function country($id)
    {
        $data = null;
        if (!empty($id)) {
            $repo = app(BaseRepository::class);
            if (is_numeric($id)):
                $data = $repo->find($id, 'country_list');
            else:
                $data = $repo->getWhere('currency_code', $id, 'country_list');
            endif;
        }

        if (!empty($data)) {
            return (object) [
                'name' => $data->name,
                'code' => strtolower($data->iso2),
                'currency_code' => strtoupper($data->currency_code),
                'dial_code' => $data->dial_code,
                'currency_icon' => $data->currency_symbol,
                'flag' => '<i class="fi fi-' . strtolower($data->iso2) . '"></i>',

            ];
        } else {
            return (object) [
                'name' => 'United States',
                'code' => 'us',
                'currency_code' => 'USD',
                'dial_code' => '1',
                'currency_icon' => '$',
                'flag' => "<i class='fi fi-us'></i>",

            ];
        }
    }
}


if (!function_exists('__isNew')) {
    function __isNew($version)
    {
        $current_version = __settings('version');
        if ($current_version == $version) {
            return '<span class="ab-position custom_badge danger-light-active">' . __("new") . '</span>';
        }
    }
}


if (!function_exists('admin_currency_position')) {

    function admin_currency_position($amount)
    {
        $dir = !empty(__settings('currency_position')) ? __settings('currency_position') : 'left';
        $number_formats = __settings('number_format');
        if ($dir == 'right') {
            return number_formats($amount, $number_formats) . ' ' . country(__config('currency'))->currency_icon;
        } else {
            return country(__config('currency'))->currency_icon . ' ' . number_formats($amount, $number_formats);
        }
    }
}

if (!function_exists('number_formats')) {
    function number_formats($amount, $number_formats)
    {
        // Normalize input first
        $amount = normalize_amount($amount);

        switch ((int)$number_formats) {
            case 0:
                return round($amount);

            case 1:
                return number_format($amount, 2, '.', '');

            case 2:
                return number_format($amount, 2, ',', '.');

            case 4:
                return number_format($amount, 2, ',', '');

            case 5:
                return number_format($amount, 0, ',', '.');

            case 6:
                return number_format($amount, 3, '.', '');

            default:
                return number_format($amount, 2, '.', '');
        }
    }
}

if (!function_exists('__numberFormat')) {

    function __numberFormat($amount, $id = null)
    {
        if ($id == null) {
            $number_format = __settings('number_format');
        } else {
            $number_format = __settings('number_format', $id);
        }

        if ($number_format == 1) {
            return number_formats($amount, 1);
        } else {
            return number_formats($amount, 0);
        }
    }
}


if (!function_exists('normalize_amount')) {
    function normalize_amount($amount)
    {
        if ($amount === null || $amount === '') {
            return 0;
        }

        $amount = trim($amount);
        if (strpos($amount, ',') !== false && strpos($amount, '.') !== false) {
            $amount = str_replace(',', '', $amount);
        } elseif (strpos($amount, ',') !== false) {
            $amount = str_replace(',', '.', $amount);
        }

        return (float)$amount;
    }
}


if (!function_exists('__image')) {
    function __image($id, $type = 'thumb', $isPath = false)
    {
        // Optimization: Select only the columns we need ('thumb' and 'images')
        $image = \App\Models\MediaFile::find($id, ['thumb', 'images']);

        if (!$image) {
            return avatar('', 'logo');
        }

        // Return the whole model object if type is empty
        if (empty($type)) {
            return $image;
        }

        // Determine which column to use: thumb or images
        $attribute = $type === 'thumb' ? 'thumb' : 'images';
        $path = $image->$attribute ?? null;

        // Fallback if specific column is empty
        if (empty($path)) {
            return avatar('', 'logo');
        }

        return $isPath ? $path : asset($path);
    }
}

if (!function_exists('avatar')) {
    function avatar($img = '', $type = 'profile')
    {
        // 1. Handle comma-separated strings (take the first one)
        if (is_string($img) && strpos($img, ',') !== false) {
            $img = explode(',', $img)[0];
        }

        // 2. Handle Database ID
        if (is_numeric($img)) {
            // Optimization: Select only 'thumb'
            $media = \App\Models\MediaFile::find($img, ['thumb']);
            $img = $media->thumb ?? null;
        }

        // 3. Determine default image based on type
        $defaultPath = $type === 'profile'
            ? 'assets/images/avatar.png'
            : 'assets/images/empty.png';

        // 4. If image is empty, return default
        if (empty($img)) {
            return asset($defaultPath);
        }

        // 5. Check if file exists
        // Bug Fix: We use public_path() to check the file on the server disk, 
        // rather than checking the URL string directly.
        if (file_exists(public_path($img))) {
            return asset($img);
        }

        // 6. Fallback to default if file not found
        return asset($defaultPath);
    }
}

// if (!function_exists('isJson')) {
//     function isJson($value, $associative = false)
//     {
//         if (empty($value) || !is_string($value)) {
//             return null;
//         }

//         $decoded = json_decode($value, $associative);

//         if (json_last_error() === JSON_ERROR_NONE) {
//             return $decoded;
//         }

//         return null;
//     }
// }
