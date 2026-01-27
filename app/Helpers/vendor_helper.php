<?php

use App\Repositories\BaseRepository;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



if (!function_exists('__single')) {
    function __single($id, $table)
    {
        $base = app(BaseRepository::class);
        $data = $base->find($id, $table);
        return $data;
    }
}


if (!function_exists('shop_language')) {
    function shop_language()
    {
        return Cache::remember('shop_languages', 86400, function () {
            $base = app(BaseRepository::class);
            return $base->get_vendor_language_list();
        });
    }
}




if (!function_exists('__loader')) {
    function __loader($type = 'image')
    {
        $data = asset('assets/images/background.gif');
        return $data;
    }
}





if (!function_exists('__isset')) {
    function __isset($data = [], $property = null, $returnVal = false)
    {
        $default = ($returnVal === true) ? 0 : ($returnVal === false ? '' : $returnVal);
        return data_get($data, $property, $default);
    }
}


if (!function_exists('__vendorLanguage')) {
    function __vendorLanguage($slug)
    {
        static $cache = [];
        if (isset($cache[$slug])) {
            return $cache[$slug];
        }

        $result = Cache::remember('lang_details_' . $slug, 86400, function () use ($slug) {
            $language = DB::table('language_list')->where('slug', $slug)->first();

            if (!$language) {
                return (object) [
                    'language_name' => 'English',
                    'code' => 'us',
                    'currency_code' => 'USD',
                    'dial_code' => '1',
                    'currency_icon' => '$',
                    'flag' => "<i class='fi fi-us'></i>",
                ];
            }

            $data = country($language->country_id);

            if (!empty($data)) {
                return (object) [
                    'language_name' => $language->language_name,
                    'dial_code' => $data->dial_code,
                    'currency_icon' => $data->currency_icon,
                    'flag' => '<i class="fi fi-' . $data->code . '"></i>',
                ];
            } else {
                return (object) [
                    'language_name' => 'English',
                    'code' => 'us',
                    'currency_code' => 'USD',
                    'dial_code' => '1',
                    'currency_icon' => '$',
                    'flag' => "<i class='fi fi-us'></i>",
                ];
            }
        });

        $cache[$slug] = $result;
        return $result;
    }
}



if (!function_exists('country_list')) {
    function country_list()
    {
        $base = app(BaseRepository::class);
        return $base->get_country_list();
    }
}



if (!function_exists('_ID')) {
    function _ID($id = null)
    {
        // Step 1: Check static cache (for same request)
        static $cache = [];
        $key = $id ?? 'default';

        if (isset($cache[$key])) {
            return $cache[$key];
        }

        // Step 2: Check Laravel Cache (across requests)
        $cacheKey = 'vendor_id_' . ($id ?? 'auth_' . (Auth::id() ?? 'guest'));

        $result = Cache::remember($cacheKey, 300, function () use ($id) {
            // Get the vendor ID
            if (!empty($id)) {
                if (is_numeric($id)) {
                    return DB::table('vendor_list')
                        ->where('user_id', $id)
                        ->where('is_primary', 1)
                        ->value('id') ?? 0;
                } else {
                    return DB::table('vendor_list')
                        ->where('username', $id)
                        ->value('id') ?? 0;
                }
            } elseif (request()->has('vendor_id')) {
                return request('vendor_id');
            } elseif (request()->has('u')) {
                return DB::table('vendor_list')
                    ->where('username', request('u'))
                    ->value('id') ?? 0;
            } elseif (Auth::check()) {
                return DB::table('vendor_list')
                    ->where('user_id', Auth::id())
                    ->where('is_primary', 1)
                    ->value('id') ?? 0;
            }

            return 0;
        });

        // Store in static cache too
        $cache[$key] = $result;

        return $result;
    }
}



if (!function_exists('__activeVendor')) {
    function __activeVendor($column = 'id')
    {
        static $vendorCache = [];
        $id = _ID();

        if ($id <= 0) return 0;
        if ($column == 'id') return $id;

        if (!isset($vendorCache[$id])) {
            $vendorCache[$id] = DB::table('vendor_list')->where('id', $id)->first();
        }

        if (is_null($column) || $column == 'all') {
            return $vendorCache[$id];
        }

        return $vendorCache[$id]->$column ?? 0;
    }
}


if (!function_exists('__vendorId')) {
    function __vendorId($vendorId = null)
    {
        $vendorId = $vendorId ?? _ID();
        return $vendorId;
    }
}


if (!function_exists('__langData')) {
    function __langData($id, $columnName, $table)
    {
        $base = app(BaseRepository::class);
        return $base->get_lang_data($id, $columnName, $table);
    }
}



if (!function_exists('__names')) {
    function __names($object, $type_name = 'category_name', $is_flag = false)
    {
        if (empty($object)) {
            return '';
        }

        // If it's a single Eloquent model with HasTranslations trait
        if ($object instanceof \Illuminate\Database\Eloquent\Model && method_exists($object, 'getTranslations')) {
            if ($is_flag === true) {
                // Use the model's translations for the flags
                $object = $object->getTranslations();
            } else {
                // Just return the localized name for the current locale
                return $object->$type_name;
            }
        }

        if ($is_flag == true) {
            $html = '';

            foreach ($object as $item) {
                $langDetails = __vendorLanguage($item->language);

                $html .= '<div class="langItem">';
                $html .= '<span data-title="' . $langDetails->language_name . '" data-toggle="tooltip"
                            data-original-title="" title="">
                            ' . $langDetails->flag . '
                        </span>';

                $html .= '<span class="title-text">' . ($item->$type_name ?? '') . '</span>';
                $html .= '</div>';
            }

            return $html;
        } else {
            $names = [];
            foreach ($object as $value) {
                // This works for both stdClass and Eloquent models (via magic __get)
                $names[] = ($value->$type_name) ?? '';
            }
            return implode(', ', $names);
        }
    }
}


if (!function_exists('__uid')) {
    /**
     * Generate a unique UID with race condition protection
     * 
     * @param int $digit Length of the UID (default 8)
     * @param string $table Table name to check uniqueness against
     * @param int $maxRetries Maximum retry attempts (default 10)
     * @return string Unique uppercase UID
     * @throws \RuntimeException if unable to generate unique UID after max retries
     */
    function __uid(int $digit = 8, string $table = '', int $maxRetries = 10)
    {
        $attempts = 0;

        do {
            // Generate random UID using uppercase alphanumeric characters
            $uid = strtoupper(Str::random($digit));

            // If no table specified, return immediately (no uniqueness check needed)
            if (empty($table)) {
                return $uid;
            }

            // Check if UID already exists
            $exists = DB::table($table)->where('uid', $uid)->exists();

            $attempts++;

            // Prevent infinite loop
            if ($attempts >= $maxRetries) {
                throw new \RuntimeException(
                    "Failed to generate unique UID after {$maxRetries} attempts for table '{$table}'. Consider increasing digit length."
                );
            }
        } while ($exists);

        return $uid;
    }
}



if (!function_exists('__variantPrice')) {
    function __variantPrice($row, $language = false)
    {
        $base = app(BaseRepository::class);
        $html = '';

        if (empty($row)) {
            return $html;
        }

        $variantClass = (isset($row->is_variants) && $row->is_variants == 1)
            ? 'variantGroup'
            : '';

        $html .= '<div class="priceGroup ' . $variantClass . '">';

        // ================= VARIANT ITEMS =================
        if (isset($row->is_variants) && $row->is_variants == 1) {

            // Get variants
            if ($row instanceof \App\Models\Item) {
                $variants = $row->getTranslations();
            } else {
                $variants = $base->get_variants_by_item_id($row->id);
            }

            $variantDetails = [];

            foreach ($variants as $var) {

                if (empty($var->variants)) {
                    continue;
                }

                $decoded = json_decode($var->variants);

                // 🔒 Guard invalid JSON
                if (
                    json_last_error() !== JSON_ERROR_NONE ||
                    empty($decoded) ||
                    !is_object($decoded)
                ) {
                    continue;
                }

                // 🔒 Prevent overwriting valid language data
                if (!isset($variantDetails[$var->language])) {
                    $variantDetails[$var->language] = $decoded;
                }
            }

            // Render variants
            foreach ($variantDetails as $lang => $value) {

                // 🔒 HARD GUARD (this fixes your error)
                if (
                    !isset($value->variant_name) ||
                    empty($value->variant_options) ||
                    !is_array($value->variant_options)
                ) {
                    continue;
                }

                $langDetails = __vendorLanguage($lang);

                $html .= '<div class="variantArea">';

                if ($language === true && $langDetails) {
                    $html .= '<div class="langItem">';
                    $html .= '<span data-title="' . e($langDetails->language_name) . '" data-toggle="tooltip">'
                        . $langDetails->flag . '</span>';
                    $html .= '<span>' . e($value->variant_name) . '</span>';
                    $html .= '</div>';
                }

                $html .= '<ul>';

                foreach ($value->variant_options as $v) {

                    if (!isset($v->name, $v->price)) {
                        continue;
                    }

                    $html .= '<li><a href="javascript:;">'
                        . e($v->name) . ' : '
                        . __currency_position($v->price)
                        . '</a></li>';
                }

                $html .= '</ul>';
                $html .= '</div>';
            }

            // ================= NON-VARIANT ITEMS =================
        } else {

            if (!empty($row->price)) {
                $html .= "<span class='currentPrice'>"
                    . __currency_position($row->price)
                    . "</span>";

                if (!empty($row->previous_price)) {
                    $html .= "<span class='previous_price'>"
                        . __currency_position($row->previous_price)
                        . "</span>";
                }
            }
        }

        $html .= '</div>';

        return $html;
    }
}



if (!function_exists('__vegType')) {
    function __vegType($row, $is_text = false, $type = 'round')
    {
        $html = '';
        if (isset($row->veg_type) && !empty($row->veg_type)) {
            if ($is_text == true) :
                $html .= '<span class="vegType ' . $type . ' ' . $row->veg_type . '"> <span></span>' . __($row->veg_type == 'nonveg' ? 'non_vegetarian' : 'vegetarian') . "</span>";
            else :
                $html .= '<span data-title="' . __($row->veg_type == 'nonveg' ? 'non_vegetarian' : 'vegetarian') . '" data-toggle="tooltip" class="vegType ' . $type . ' ' . $row->veg_type . '"><span></span></span>';
            endif;
        }

        return $html;
    }
}


if (!function_exists('__itemTax')) {
    function __itemTax($item, $vendor_id = null, $isItem = true)
    {
        $taxItems = [];
        $vendor_id = !empty($vendor_id) ? $vendor_id : __activeVendor('id');

        // Use static cache for vendor taxes to avoid repeated queries
        static $vendorTaxes = [];
        if (!isset($vendorTaxes[$vendor_id])) {
            $vendorTaxes[$vendor_id] = DB::table('vendor_tax_list')
                ->where('vendor_id', $vendor_id)
                ->where('status', 1)
                ->get()
                ->keyBy('id');
        }

        // Get tax IDs from the item object or ID
        if (is_object($item)) {
            $taxIds = isset($item->tax) && !empty($item->tax) ? json_decode($item->tax) : [];
        } else {
            $row = DB::table('vendor_item_list')->find($item);
            $taxIds = ($row && isset($row->tax) && !empty($row->tax)) ? json_decode($row->tax) : [];
        }

        if (empty($taxIds)) {
            return '';
        }

        $taxs = [];
        foreach ($taxIds as $id) {
            if (isset($vendorTaxes[$vendor_id][$id])) {
                $taxs[] = $vendorTaxes[$vendor_id][$id];
            }
        }

        if (empty($taxs)) {
            return '';
        }

        foreach ($taxs as $tax) {
            $taxStatus = $tax->tax_status == 'include' ? __('included') : __('excluded');
            $taxItems[] = "{$tax->tax_name} {$tax->tax_percentage}% {$taxStatus}";
        }

        $taxList = implode(', ', $taxItems);

        $html = '';
        $html .= '<div class="taxArea">';

        if ($isItem == true) :
            $html .= '<p class="taxName">';
            $html .= "<small>{$taxList}</small>";
            $html .= '</p>';
        else :
            $html .= '<ul class="taxName">';
            foreach ($taxs as $key => $tax) {
                $taxStatus = $tax->tax_status == 'include' ? __('included') : __('excluded');
                $html .= "<li> <span>{$tax->tax_name} {$tax->tax_percentage} % {$taxStatus}</span> <span></span></li>";
            }
            $html .= '</ul>';
        endif;
        $html .= '</div>';
        return $html;
    }
}




if (!function_exists('get_subcategories_by_cat_id')) {
    function get_subcategories_by_cat_id($cat_id)
    {
        $subcategories = \App\Models\Subcategory::where('vendor_id', __activeVendor('id'))
            ->where('category_id', $cat_id)
            ->get();

        \App\Models\Subcategory::loadTranslations($subcategories);
        return $subcategories;
    }
}


if (!function_exists('str_slug')) {
    function str_slug($string, $separator = '-')
    {
        return Str::slug($string, $separator);
    }
}


if (!function_exists('single_variants_by_item_id')) {
    function single_variants_by_item_id($item_id, $lang)
    {
        return DB::table('vendor_item_list_ln')->where('item_id', $item_id)->where('language', $lang)->first();
    }
}


if (!function_exists('__selectln')) {
    function __selectln($table, $check_id, $isActive = false)
    {
        $base = app(BaseRepository::class);
        return $base->get_ln_data($table, $check_id, $isActive);
    }
}


if (!function_exists('__aExtra')) {
    function __aExtra($ext, $type = 'price')
    {
        if ($type === 'price') {
            return (float) $ext->price == null ? (float) ($ext->addonLibrary->price ?? 0) : (float) $ext->price;
        }

        if ($type === 'max_qty') {
            return (int) $ext->max_select_qty == null ? ($ext->addonLibrary->max_select_qty ?? 0) : (int) $ext->max_select_qty;
        }

        return 0;
    }
}
if (!function_exists('__vsettings')) {
    function __vsettings($key, $default = '', $vendorId = null)
    {
        return app(\App\Services\VendorSettingsService::class)->get($key, $default, $vendorId);
    }
}

if (!function_exists('__vcountry')) {
    function __vcountry($vendorId = null)
    {
        $countryId = __vsettings('country_id', 0, $vendorId);
        return country($countryId);
    }
}

if (!function_exists('__vcheck')) {
    function __vcheck($data, $vendorId = null)
    {
        $service = app(\App\Services\VendorSettingsService::class);
        if (is_array($data)) {
            return $service->save($data, $vendorId);
        }
        return !empty($service->get($data, '', $vendorId));
    }
}

if (!function_exists('__vsettings_save')) {
    function __vsettings_save(array $data, $vendorId = null)
    {
        return app(\App\Services\VendorSettingsService::class)->save($data, $vendorId);
    }
}

if (!function_exists('__resetCache')) {

    function __resetCache(string $type, $vendorId = null, $userId = null): void
    {
        $key = makeCacheKey($type, $vendorId, $userId);
        Cache::forget($key);
    }
}




if (!function_exists('__clearVendorCache')) {
    /**
     * Clear all cached data for a vendor (categories, subcategories, etc.)
     */
    function __clearVendorCache($vendorId = null, $userId = null): void
    {
        app(\App\Repositories\VendorRepository::class)->clearAllCache($vendorId, $userId);
    }
}


if (!function_exists('__currency_position')) {

    function __currency_position($amount, $id = null)
    {
        $dir = !empty(__vsettings('currency_position', $id)) ? __vsettings('currency_position', $id) : 'left';
        $number_formats = __vsettings('number_format', $id);
        if ($dir == 'right') {
            return number_formats($amount, $number_formats) . ' ' . country(__config('currency'))->currency_icon;
        } else {
            return country(__config('currency'))->currency_icon . ' ' . number_formats($amount, $number_formats);
        }
    }
}
