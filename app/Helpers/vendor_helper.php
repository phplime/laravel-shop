<?php

use App\Repositories\BaseRepository;
use App\Services\SettingsService;
use Illuminate\Container\Attributes\Auth;
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
        $base = app(BaseRepository::class);
        $data = $base->get_vendor_language_list();
        return $data;
    }
}


if (!function_exists('__image')) {

    function __image($value, $type = 'thumb', $isPath = false, $all = false)
    {
        // -----------------------------
        // 1. Normalize input
        // -----------------------------
        if (empty($value)) {
            return avatar('', 'logo');
        }

        // If CSV → convert to array
        if (is_string($value) && str_contains($value, ',')) {
            $value = array_filter(array_map('trim', explode(',', $value)));
        }

        // If single numeric string → convert to array [id]
        if (is_numeric($value)) {
            $value = [(int) $value];
        }

        // If it's not array yet, force array
        if (!is_array($value)) {
            $value = [$value];
        }

        // Clean numeric IDs
        $ids = array_filter($value, fn($v) => is_numeric($v));

        if (empty($ids)) {
            return avatar('', 'logo');
        }

        // -----------------------------
        // 2. Fetch images
        // -----------------------------
        $images = \App\Models\MediaFile::whereIn('id', $ids)
            ->orderBy('id', 'desc')
            ->get();

        if ($images->isEmpty()) {
            return avatar('', 'logo');
        }

        // -----------------------------
        // 3. If $all = true → return all images
        // -----------------------------
        if ($all) {
            return $images->map(function ($img) use ($type, $isPath) {
                return __image_return($img, $type, $isPath);
            })->values();  // return a clean array
        }

        // -----------------------------
        // 4. If single mode → return first
        // -----------------------------
        $first = $images->first();

        return __image_return($first, $type, $isPath);
    }
}

/**
 * Helper to extract the real image based on type
 */
if (!function_exists('__image_return')) {
    function __image_return($image, $type, $isPath)
    {
        if (!$image) {
            return avatar('', 'logo');
        }

        $field = $type === 'thumb' ? 'thumb' : 'images';
        $path  = $image->$field ?? '';

        if (!$path) {
            return avatar('', 'logo');
        }

        if ($isPath) {
            return $path; // raw path
        }

        return asset($path); // full URL
    }
}


if (!function_exists('avatar')) {
    function avatar($img = '', $type = 'profile')
    {
        // 1. If comma-separated, use first one
        if (!empty($img) && is_string($img) && str_contains($img, ',')) {
            $img = explode(',', $img)[0];
        }

        // 2. If numeric → load media record
        if (is_numeric($img)) {
            $file = \App\Models\MediaFile::find($img);
            $img = $file->thumb ?? '';
        }

        // 3. If file exists in public folder
        if (!empty($img)) {
            $fullPath = public_path($img);
            if (file_exists($fullPath)) {
                return asset($img);
            }
        }

        // 4. Fallback images
        if ($type === 'profile') {
            return asset(config('media.default_avatar', 'images/default-avatar.png'));
        }

        return asset(config('media.empty_image', 'images/empty.png'));
    }
}



if (!function_exists('__isset')) {
    function __isset($data = [], $property = null, $returnVal = false)
    {
        $default = ($returnVal === true) ? 0 : ($returnVal === false ? '' : $returnVal);

        if (is_array($data)) {
            $value = isset($data[$property]) && !empty($data[$property]) ? $data[$property] : $default;
        } elseif (is_object($data)) {
            $value = isset($data->$property) && !empty($data->$property) ? $data->$property : $default;
        } else {
            $value = isset($data) && !empty($data) ? $data : $default;
        }

        return $value;
    }
}


if (!function_exists('__single_lang_by_slug')) {
    function __single_lang_by_slug($slug)
    {
        $language = DB::table('language_list')->where('slug', $slug)->first();
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
    }
}



if (!function_exists('country_list')) {
    function country_list()
    {
        $base = app(BaseRepository::class);
        return $base->get_country_list();
    }
}



if (!function_exists('__activeVendor')) {
    function __activeVendor($column = 'id')
    {
        return 1;
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
        if (!empty($object)) {

            if ($is_flag == true) {
                $html = '';

                foreach ($object as $item) {

                    $langDetails = __single_lang_by_slug($item->language);

                    $html .= '<div class="langItem">';

                    $html .= '<span data-title="' . $langDetails->language_name . '" data-toggle="tooltip"
                                data-original-title="" title="">
                                ' . $langDetails->flag . '
                            </span>';

                    $html .= '<span class="title-text">' . $item->$type_name . '</span>';
                    $html .= '</div>';
                }

                return $html;
            }else{
                $names = [];
                foreach ($object as $value) {
                    $names[] = ($value->$type_name) ??'';
                }
                return implode(', ', $names);
            }
        }
    }
}


if (!function_exists('__uid')) {
    function __uid(int $digit = 8, string $table = '')
    {
        do {
            $uid = strtoupper(Str::random($digit));
        } while (
            !empty($table) && DB::table($table)->where('uid', $uid)->exists()
        );

        return $uid;
    }
}



if(!function_exists('__variantPrice')){
    function __variantPrice($row, $language = false)
    {
        $base = app(BaseRepository::class);
        $html = '';

        if (!empty($row)) {

            $variantClass = isset($row->is_variants) && $row->is_variants == 1 ? 'variantGroup':'';

            $html .= '<div class="priceGroup '.$variantClass.'">';

            if (isset($row->is_variants) && $row->is_variants == 1) {

                $variant = $base->get_variants_by_item_id($row->id);
                $variant_details = [];

                foreach ($variant as $var) {
                    $variant_details[$var->language] = json_decode($var->variants);
                }

                foreach ($variant_details as $key => $value)
                {
                    $langDetails = __single_lang_by_slug($key);
                    $html .= '<div class="variantArea">';

                    if ($language == true) {
                        $html .= '<div class="langItem">';
                        $html .= '<span data-title="'.$langDetails->language_name.'" data-toggle="tooltip">'.$langDetails->flag.'</span>';
                        $html .= '<span>'.$value->variant_name.'</span>';
                        $html .= '</div>';
                    }

                    $html .= '<ul>';
                    foreach ($value->variant_options as $v) {
                        $html .= '<li><a href="javascript:;">'.$v->name.' : '.$v->price.'.00 $</a></li>';
                    }
                    $html .= '</ul>';
                    $html .= '</div>';
                }
            }else{
                if (isset($row->price) && !empty($row->price)) {
                    $html .=  " <span class='currentPrice'>" . $row->price . "$</span>";

					if (isset($row->previous_price) && !empty($row->previous_price)) {
						$html .=  " <span class='previous_price'>" . $row->previous_price . "$</span>";
					}
                }
            }
            $html .= '</div>';
        }

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
	function __itemTax($item_id, $vendor_id = null, $isItem = true)
	{
		$taxItems = [];
		$vendor_id = !empty($vendor_id) ? $vendor_id : __activeVendor('id');

        $base = app(BaseRepository::class);

		$taxs = $base->get_item_tax($item_id);

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
        return DB::table('vendor_subcategory_list')->where('vendor_id', __activeVendor('id'))->where('category_id', $cat_id)->get();
    }
}


if (!function_exists('str_slug')) {
	function str_slug($string, $separator = '-')
	{
		$string = trim($string);
		$string = mb_strtolower($string, 'UTF-8');
		$string = preg_replace('/\s+/', $separator, $string);
		return $string;
	}
}


if(!function_exists('single_variants_by_item_id')){
    function single_variants_by_item_id($item_id, $lang){
        return DB::table('vendor_item_list_ln')->where('item_id', $item_id)->where('language', $lang)->first();
    }
}


if(!function_exists('__selectln')){
    function __selectln($table, $check_id, $isActive = false)
    {
        $base = app(BaseRepository::class);
        return $base->get_ln_data($table, $check_id, $isActive);
    }
}


if (!function_exists('__aExtra')) {
	function __aExtra($ext, $type = 'price')
	{
		$is_active = $ext->is_active == 1;

		if ($type === 'price') {
			return $is_active ? ($ext->item_extra_price ?? 0) : ($ext->price ?? 0);
		}

		if ($type === 'max_qty') {
			return $is_active ? ($ext->item_extra_max_select_qty ?? 0) : ($ext->max_select_qty ?? 0);
		}

		return 0;
	}
}
