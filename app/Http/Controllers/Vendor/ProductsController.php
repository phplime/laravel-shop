<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

use function Symfony\Component\Clock\now;

class ProductsController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }


    public function index()
    {
        $data = [];
        $data['page_title'] = 'Products';
        $data['page'] = 'products';
        $data['categories'] = $this->baseRepo->get_category_by_select_ln_data();
        $data['product_list'] = $this->baseRepo->get_vendor_products();

        // echo '<pre>';print_r($data['categories']);exit();

        return __mainContent('backend.products.product_list', $data);
    }
    /* ======================================
    Products List Area ENd
    ======================================== */



    public function create_product()
    {
        $data = [];
        $data['page_title'] = 'Create Product';
        $data['page'] = 'products';
        $data['categories'] = $this->baseRepo->select_by_vendor_id('vendor_category_list');
        $data['tax_list'] = $this->baseRepo->select_by_vendor_id('vendor_tax_list');
        $data['allergen_list'] = $this->baseRepo->select_by_vendor_id('vendor_allergen_list');

        return __mainContent('backend.products.create_product', $data);
    }
    /* ======================================
    Create Product Area End
    ======================================== */



    public function edit_product($id)
    {
        $data = [];
        $data['page_title'] = 'Edit Product';
        $data['page'] = 'products';
        $data['categories'] = $this->baseRepo->select_by_vendor_id('vendor_category_list');
        $data['tax_list'] = $this->baseRepo->select_by_vendor_id('vendor_tax_list');
        $data['allergen_list'] = $this->baseRepo->select_by_vendor_id('vendor_allergen_list');

        $data['item'] = $this->baseRepo->get_vendor_product_id($id);

        // echo '<pre>';print_r($data['item']);exit();

        return __mainContent('backend.products.create_product', $data);
    }
    /* ======================================
    Create Product Area End
    ======================================== */



    public function add_product(Request $request)
    {
        $is_size_check = $request->is_variants ?: 0;

        try {
            $rules = [
                'category_id' => 'required',
                'title.*'     => 'required',
            ];

            if ($is_size_check == 0) {
                $rules['price']          = 'required|numeric|min:0';
                $rules['previous_price'] = 'required|numeric|min:0';
            }

            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }


        $data = [
            'uid' => __uid(8, 'vendor_item_list'),
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor('id'),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'is_variants' => $request->is_variants ?: 0,
            'price' => $request->price ?: 0,
            'previous_price' => $request->previous_price ?: 0,
            'tax' => json_encode($request->tax ?: ''),
            'images' => $request->image ?: '',
            'thumb' => $request->image ?: '',
            'allergen_ids' => json_encode($request->allergen_names ?: ''),
            'veg_type' => $request->veg_type,
            'is_feature' => $request->is_feature ?: 0,
            'created_at' => now(),
        ];


        if ($request->id == 0) {
            $insert = $this->baseRepo->create($data, 'vendor_item_list');
        } else {
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_item_list');
        }


        if ($insert) {
            $this->add_product_ln($insert, $request);

            return __request(1, __('success_text'), url('vendor/products'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }


    public function add_product_ln($insert_id, $request)
    {
        if ($insert_id) {
            foreach ($request->languages as $lang) {
                $title = $request->title[$lang] ?? '';
                $description = $request->description[$lang] ?? '';
                $variantTitle = $request->variant_name[$lang] ?? '';

                $variants = [];

                if (!empty($variantTitle) && !empty($request->variants)):
                    foreach ($request->variants as $variant)
                    {
                        $variantName = $variant[$lang]['name'] ?? '';
                        $variantPrice = $variant[$lang]['price'] ?? 0;
                        if ($variantName !== ''):
                            $variants[] = [
                                'name' => $variantName,
                                'price' => $variantPrice,
                            ];
                        endif;
                    }
                endif;

                $variantJson = !empty($variantTitle) ? json_encode(['variant_name' => $variantTitle, 'variant_options' => $variants,]) : null;

                $ln_data = [
                    'item_id' => $insert_id,
                    'title' => $title,
                    'variants' => $variantJson,
                    'description' => $description,
                    'language' => $lang,
                ];

                $exits_check = DB::table('vendor_item_list_ln')->where('item_id', $insert_id)->where('language', $lang)->first();

                if ($exits_check) {
                    $this->baseRepo->update($exits_check->id, $ln_data, 'vendor_item_list_ln');
                } else {
                    $this->baseRepo->create($ln_data, 'vendor_item_list_ln');
                }
            }
        }
    }
    /* ======================================
    Add Products ln area End
    ======================================== */



    public function get_subcategory($cat_id)
    {
        $subcategory = DB::table('vendor_subcategory_list')->where('user_id', Auth::id())->where('vendor_id', __activeVendor('id'))->where('category_id', $cat_id)->get();

        $html = '';

        if ($subcategory->count() > 0) {
            $html .= '<option value="">' . __('select') . '</option>';
            foreach ($subcategory as $value) {

                $subcat_names = __langData($value->id, 'subcategory_id', 'vendor_subcategory_list_ln');
                if ($value->status == 1):
                    $html .= '<option value="' . $value->id . '">' . __names($subcat_names, 'subcategory_name') . '</option>';
                endif;
            }
        } else {
            $html .= '<option value="">' . __('not_found') . '</option>';
        }

        return json_encode(['data' => $html]);
    }
    /* ======================================
    Get Subcategory Area ENd
    ======================================== */



    public function create_product_variants(Request $request, $lang = 'en')
    {
        try {
            $request->validate([
                'variant_name' => 'required',
                'variant_options' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $data = [];
        $data['variant_name'] = $request->variant_name;
        $variant_options = $request->variant_options;
        $data['options'] = $variant_options;

        if (strpos($variant_options, ',') !== false) {
            $get_variants = explode(",", $variant_options);
        } elseif (strpos($variant_options, '|') !== false) {
            $get_variants = explode("|", $variant_options);
        } else {
            $get_variants = explode("|", $variant_options);
        }

        $data['get_variants'] = $get_variants;
        $data['lang'] = $lang;

        $load = View::make('backend.products.inc.ajax_variants', $data)->render();

        return json_encode(['st' => 1, 'load_data' => $load]);
    }
    /* ======================================
    Create Products Variant ARea End
    ======================================== */



    public function addons($id)
    {
        $data = [];
        $data['page_title'] = 'Addons';
        $data['page'] = 'products';
        $data['item_id'] = $id;
        $data['extras_libraries'] = __selectln('vendor_addon_library', 'addon_id', true);
        $data['get_addons'] = $this->baseRepo->get_my_addons_by_item_id($id);

        // echo '<pre>';print_r($data['get_addons']);exit();

        return __mainContent('backend.products.addon_list', $data);
    }
    /* ======================================
    Addon List Area End
    ======================================== */



    public function add_new_extras(Request $request)
    {
        try {
            $request->validate([
                'title.*' => 'required',
                'is_single_select' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $extras_title = $request->title;
        $item_id = $request->item_id;

        $data = array(
            'item_id' => $item_id,
            'vendor_id' => __activeVendor('id'),
            'user_id' => Auth::id(),
            'is_required' => $request->is_required ?? 0,
            'is_single_select' => $request->is_single_select ?? 0,
            'select_limit' => $request->select_limit ?? 1,
            'select_max_limit' => isset($request->select_max_limit) ? $request->select_max_limit : 0,
            'max_qty' => isset($request->max_qty) ? $request->max_qty : 1,
            'created_at' => now(),
        );

        if (isset($request->extra_title_id) && !empty($request->extra_title_id)) {
            $insert = $this->baseRepo->update($request->extra_title_id, $data, 'vendor_extra_title_list');
        } else {
            $insert = $this->baseRepo->create($data, 'vendor_extra_title_list');
        }

        if ($insert) {
            if (is_array($extras_title)) {
                foreach ($extras_title as $lang => $names)
                {
                    $data = ['title' => $names];

                    $this->baseRepo->check_existing_language_datas($insert, 'extra_title_id', $lang, $data, 'vendor_extra_title_list_ln');
                }
            }
            return __request(1, __('success_text'), url('vendor/products/addons/'.$item_id.'?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }
    /* ======================================
    Add New Extra Area End
    ======================================== */



    public function add_library_extras(Request $request)
    {
        try {
            $request->validate([
                'addon_id.*' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $data = [];
        $item_id = $request->item_id;
        $extra_title_id = $request->extra_title_id;


        if (isset($request->addon_id)) {
            foreach ($request->addon_id as $value) {
                $data = array(
						'vendor_id' => __activeVendor(),
						'addon_id' => $value,
						'item_id' => $item_id,
						'extra_title_id' => $extra_title_id ?? 0,
						'max_select_qty' => $request->max_select_qty[$value] ?? 0,
					);

                $insert = $this->baseRepo->create($data, 'item_extra_list');
            }
        }


        if ($insert) {
            return __request(1, __('success_text'), url('vendor/products/addons/'.$item_id.'?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }

    }



    public function edit_assing_extra(Request $request)
    {
        try {
            $request->validate([
                'price' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $item_id = $request->item_id;
        $id = $request->id;

        $data = [
            'price' => $request->price ?? 0,
            'max_select_qty' => $request->max_select_qty ?? 0,
            'is_active' => 1
        ];

		$update = $this->baseRepo->update($id, $data, 'item_extra_list');

        if ($update) {
            return __request(1, __('success_text'), url('vendor/products/addons/'.$item_id.'?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }

    }



    public function add_item_addons(Request $request)
    {
        try {
            $request->validate([
                'addon_name.*' => 'required',
                'price' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $addon_names = $request->addon_name;

        $data = [
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor('id'),
            'price' => $request->price,
            'max_select_qty' => $request->max_select_qty,
            'images' => $request->image,
            'thumb' => $request->image,
            'created_at' => now()
        ];

        $item_id = $request->item_id;

        if (isset($request->id) && !empty($request->id)) {
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_addon_library');
        } else {
            $insert = $this->baseRepo->create($data, 'vendor_addon_library');
        }

        if ($insert) {

            if (is_array($addon_names)):
                foreach ($addon_names as $lang => $names)
                {
                    $data = ['addon_name' => $names];
                    $this->baseRepo->check_existing_language_datas($insert, 'addon_id', $lang, $data, 'vendor_addon_library_ln');
                }
            endif;

            return __request(1, __('success_text'), url('vendor/products/addons/'.$item_id.'?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }



    public function category_list()
    {
        $data = [];
        $data['page_title'] = 'Categories';
        $data['page'] = 'products';
        $user_id = Auth::id();
        $data['category_list'] = $this->baseRepo->get_vendor_category($user_id);
        return __mainContent('backend.products.category_list', $data);
    }
    /* ======================================
    Category List Area End
    ======================================== */



    public function add_category(Request $request)
    {
        try {
            $request->validate([
                'category_name.*' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $cat_name = $request->category_name;
        $user_id = Auth::id();


        $data = [
            'user_id' => $user_id,
            'vendor_id' => __activeVendor('id'),
            'images' => $request->image,
            'thumb' => $request->image,
            'status' => 1,
            'created_at' => now()
        ];


        if (isset($request->id) && !empty($request->id)):
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_category_list');
        else:
            $insert = $this->baseRepo->create($data, 'vendor_category_list');
        endif;


        if ($insert) {
            if (is_array($cat_name)) {
                foreach ($cat_name as $lang => $names)
                {
                    $data = ['category_name' => $names];

                    $this->baseRepo->check_existing_language_datas($insert, 'category_id', $lang, $data, 'vendor_category_list_ln');
                }
            }
            return __request(1, __('success_text'), url('vendor/products/categories?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }
    /* ======================================
    Add Category Area End
    ======================================== */



    public function subcategory_list()
    {
        $data = [];
        $data['page_title'] = 'Sub Categories';
        $data['page'] = 'products';
        $user_id = Auth::id();

        $data['category_list'] = $this->baseRepo->get_vendor_category($user_id);
        $data['subcategory_list'] = $this->baseRepo->get_subcategories($user_id);
        $data['subcategories'] = $this->baseRepo->select_by_vendor_id('vendor_subcategory_list');
        // echo '<pre>';print_r($data['subcategories']);exit();

        return __mainContent('backend.products.subcategory_list', $data);
    }
    /* ======================================
    Sub Category List Area ENd
    ======================================== */



    public function add_subcategory(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'subcategory_name.*' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $subcategory_name = $request->subcategory_name;

        $data = [
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor('id'),
            'category_id' => $request->category_id,
            'images' => $request->image,
            'thumb' => $request->image,
            'created_at' => now()
        ];

        if (isset($request->id) && !empty($request->id)):
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_subcategory_list');
        else:
            $insert = $this->baseRepo->create($data, 'vendor_subcategory_list');
        endif;

        if ($insert) {
            if (is_array($subcategory_name)) {
                foreach ($subcategory_name as $lang => $names)
                {
                    $data = ['subcategory_name' => $names];

                    $this->baseRepo->check_existing_language_datas($insert, 'subcategory_id', $lang, $data, 'vendor_subcategory_list_ln');
                }
            }
            return __request(1, __('success_text'), url('vendor/products/subcategories?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }
    /* ======================================
    Add Sub Category Area ENd
    ======================================== */


    public function allergen_list()
    {
        $data = [];
        $data['page_title'] = 'Allergens';
        $data['page'] = 'products';
        $data['allergen_list'] = $this->baseRepo->select_by_vendor_id('vendor_allergen_list');

        return __mainContent('backend.products.allergen_list', $data);
    }
    /* ======================================
    Allergen List Area End
    ======================================== */



    public function add_allergen(Request $request)
    {
        try {
            $request->validate([
                'allergen_name.*' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $allergen_names = $request->allergen_name;

        $data = [
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor('id'),
            'images' => $request->image,
            'thumb' => $request->image,
            'created_at' => now()
        ];


        if (isset($request->id) && !empty($request->id)) {
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_allergen_list');
        } else {
            $insert = $this->baseRepo->create($data, 'vendor_allergen_list');
        }


        if ($insert) {
            if (is_array($allergen_names)) {
                foreach ($allergen_names as $lang => $names)
                {
                    $data = ['allergen_name' => $names];
                    $this->baseRepo->check_existing_language_datas($insert, 'allergen_id', $lang, $data, 'vendor_allergen_list_ln');
                }
            }
            return __request(1, __('success_text'), url('vendor/products/allergens?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }
    /* ======================================
    Add Allergen Area ENd
    ======================================== */



    public function addons_library()
    {
        $data = [];
        $data['page_title'] = 'Addon Library';
        $data['page'] = 'products';
        $data['addon_list'] = $this->baseRepo->select_by_vendor_id('vendor_addon_library');
        return __mainContent('backend.products.addon_library', $data);
    }
    /* ======================================
    Addons List Area ENd
    ======================================== */



    public function add_addon(Request $request)
    {
        try {
            $request->validate([
                'addon_name.*' => 'required',
                'price' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $addon_names = $request->addon_name;

        $data = [
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor('id'),
            'price' => $request->price,
            'max_select_qty' => $request->max_select_qty,
            'images' => $request->image,
            'thumb' => $request->image,
            'created_at' => now()
        ];


        if (isset($request->id) && !empty($request->id)) {
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_addon_library');
        } else {
            $insert = $this->baseRepo->create($data, 'vendor_addon_library');
        }

        if ($insert) {

            if (is_array($addon_names)):
                foreach ($addon_names as $lang => $names) {

                    $data = [ 'addon_name' => $names];

                    $this->baseRepo->check_existing_language_datas($insert, 'addon_id', $lang, $data, 'vendor_addon_library_ln');
                }
            endif;

            return __request(1, __('success_text'), url('vendor/products/addons-library?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }
    /* ======================================
    Add Addon Area ENd
    ======================================== */
}
