<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\SubCategory;
use App\Models\AddonLibrary;
use App\Models\Allergen;
use App\Models\Category;
use App\Models\ItemExtraList;
use App\Repositories\BaseRepository;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;



class ProductsController extends Controller
{
    protected $baseRepo;
    protected $vendorRepo;
    protected $vendorId;
    protected $userId;
    protected $language;

    public function __construct(BaseRepository $baseRepo, VendorRepository $vendorRepo)
    {
        $this->baseRepo = $baseRepo;
        $this->vendorRepo = $vendorRepo;
        $this->vendorId = __activeVendor('id');
        $this->userId = Auth::id();
        $this->language = app()->getLocale();
    }


    public function index()
    {
        $data = [];
        $data['page_title'] = 'Products';
        $data['page'] = 'products';
        $data['categories'] = $this->vendorRepo->getCategoryByLanguage($this->vendorId, $this->language);
        $data['product_list'] = $this->vendorRepo->getVendorProducts($this->vendorId);

        return __mainContent('backend.products.product_list', $data);
    }




    public function create_product()
    {
        $data = [];
        $data['page_title'] = 'Create Product';
        $data['page'] = 'products';
        $data['categories'] = $this->vendorRepo->getCategoryByLanguage($this->vendorId, $this->language);
        $data['tax_list'] = $this->vendorRepo->selectByVendorId('vendor_tax_list', $this->vendorId);
        $data['allergen_list'] = $this->vendorRepo->selectByVendorIdLn('vendor_allergen_list', $this->vendorId, $this->language);

        return __mainContent('backend.products.create_product', $data);
    }


    public function show($id = null)
    {
        $data = [];
        $data['page_title'] = 'Product Details';
        $data['page'] = 'products';
        $data['row'] = $this->vendorRepo->getProductByIdWithDetails($id, $this->vendorId, $this->language);
        $data['extra_list'] = $this->vendorRepo->getAddonListByItemId($id, $this->vendorId);

        // dd($data['product']);

        return __mainContent('backend.products.product_details', $data);
    }
    /* ======================================
    Create Product Area End
    ======================================== */



    public function edit_product($id)
    {
        $data = [];
        $data['page_title'] = 'Edit Product';
        $data['page'] = 'products';
        $data['categories'] = $this->vendorRepo->getCategoryByLanguage($this->vendorId, $this->language);
        $data['tax_list'] = $this->vendorRepo->selectByVendorId('vendor_tax_list', $this->vendorId);
        $data['allergen_list'] = $this->vendorRepo->selectByVendorIdLn('vendor_allergen_list', $this->vendorId, $this->language);
        $data['item'] = $this->vendorRepo->getProductById($id, $this->vendorId);

        return __mainContent('backend.products.create_product', $data);
    }



    public function add_product(Request $request)
    {
        $is_size_check = $request->is_variants ?: 0;

        try {
            $rules = [
                'category_id'    => 'required|integer',
                'title.*'        => 'required|string',
                'id'             => 'nullable|integer',
                'subcategory_id' => 'nullable|integer',
            ];

            if ($is_size_check == 0) {
                $rules['price']          = 'required|numeric|min:0';
                $rules['previous_price'] = 'nullable|numeric|min:0';
            }

            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return __request(0, $e->validator->errors()->first(), '');
        }

        try {
            return DB::transaction(function () use ($request) {

                $vendorId = __activeVendor('id');

                $data = [
                    'user_id'        => $this->userId,
                    'vendor_id'      => $vendorId,
                    'category_id'    => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'is_variants'    => $request->is_variants ?: 0,
                    'price'          => $request->price ?: 0,
                    'previous_price' => $request->previous_price ?: 0,
                    'tax'            => json_encode($request->tax ?? []),
                    'images'         => $request->image ?: '',
                    'thumb'          => $request->image ?: '',
                    'allergen_ids'   => json_encode($request->allergen_names ?? []),
                    'veg_type'       => $request->veg_type,
                    'is_feature'     => $request->is_feature ?: 0,
                ];

                $itemId = null;

                if ($request->id) {
                    $item = Item::where('id', $request->id)
                        ->where('vendor_id', $vendorId)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $item->update($data);
                    $itemId = $item->id;
                } else {
                    $data['uid'] = __uid(8, 'vendor_item_list');
                    $item = Item::create($data);
                    $itemId = $item->id;
                }

                if (!empty($itemId)) {
                    $this->addProductLanguageData($itemId, $request);
                }

                return __request(
                    1,
                    __('success_text'),
                    url('vendor/products')
                );
            });
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return __request(0, __('Product not found'), '');
        } catch (\Throwable $e) {
            return __request(0, $e->getMessage(), '');
        }
    }


    public function addProductLanguageData($insert_id, $request)
    {
        if (!$insert_id) return;

        foreach ($request->languages as $lang) {
            $title = $request->title[$lang] ?? '';
            $description = $request->description[$lang] ?? '';
            $variantTitle = $request->variant_name[$lang] ?? '';

            // Skip if title is empty
            if (empty($title)) {
                continue;
            }

            $variants = [];

            if (!empty($variantTitle) && !empty($request->variants)) {
                foreach ($request->variants as $variant) {
                    $variantName = $variant[$lang]['name'] ?? '';
                    $variantPrice = $variant[$lang]['price'] ?? 0;
                    if ($variantName !== '') {
                        $variants[] = [
                            'name' => $variantName,
                            'price' => $variantPrice,
                        ];
                    }
                }
            }

            $variantJson = !empty($variantTitle) ? json_encode(['variant_name' => $variantTitle, 'variant_options' => $variants]) : null;

            $ln_data = [
                'title'       => $title,
                'variants'    => $variantJson,
                'description' => $description,
            ];

            DB::table('vendor_item_list_ln')->updateOrInsert(
                ['item_id' => $insert_id, 'language' => $lang],
                $ln_data
            );
        }
    }
    /* ======================================
    Add Products ln area End
    ======================================== */



    public function get_subcategory($cat_id)
    {
        $subcategory = SubCategory::query()
            ->where('user_id', $this->userId)
            ->where('vendor_id', $this->vendorId)
            ->where('category_id', $cat_id)
            ->get();

        SubCategory::loadTranslations($subcategory);

        $html = '';

        if ($subcategory->count() > 0) {
            $html .= '<option value="">' . __('select') . '</option>';
            foreach ($subcategory as $value) {
                if ($value->status == 1):
                    $html .= '<option value="' . $value->id . '">' . __names($value->translations, 'subcategory_name') . '</option>';
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
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        $variant_name = $request->variant_name;
        $variant_options = $request->variant_options;

        // Parse variant options - support both comma and pipe delimiters
        if (strpos($variant_options, ',') !== false) {
            $variant_options_array = explode(",", $variant_options);
        } elseif (strpos($variant_options, '|') !== false) {
            $variant_options_array = explode("|", $variant_options);
        } else {
            $variant_options_array = explode("|", $variant_options);
        }

        $get_variants = [];
        foreach ($variant_options_array as $key => $value) {
            $get_variants[] = [
                'name' => trim($value),
                'price' => 0,
            ];
        }

        $data = [];
        $data['variant_name'] = $variant_name;
        $data['get_variants'] = $get_variants;
        $data['lang'] = $lang;

        // Store variant data in temporary session for 5 minutes
        __setTemp('variant_data_' . $lang, $data, 5);

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
        $data['extras_libraries'] = $this->vendorRepo->getAddonLibrary();
        $data['get_addons'] = $this->vendorRepo->getAddonListByItemId($id, $this->vendorId);

        $data['row'] = $this->vendorRepo->getProductByIdWithDetails($id, $this->vendorId, $this->language);
        $data['extra_list'] = $data['get_addons'];

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
                foreach ($extras_title as $lang => $names) {
                    $data = ['title' => $names];

                    $this->baseRepo->check_existing_language_datas($insert, 'extra_title_id', $lang, $data, 'vendor_extra_title_list_ln');
                }
            }
            return __request(1, __('success_text'), url('vendor/products/addons/' . $item_id . '?isAjax=1'));
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
                'addon_id' => 'required|array',
                'addon_id.*' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return __request(0, $e->validator->errors()->all(), '');
        }

        $vendorId = $this->vendorId;
        $itemId = $request->item_id;
        $extraTitleId = $request->extra_title_id ?? 0;

        // Prepare Data for Bulk Insert
        $insertData = [];

        foreach ($request->addon_id as $addonId) {
            $insertData[] = [
                'vendor_id'        => $vendorId,
                'extra_id'         => $addonId,
                'item_id'          => $itemId,
                'extra_title_id'   => $extraTitleId,
                'max_select_qty'   => $request->max_select_qty[$addonId] ?? 0,
            ];
        }

        $insert = ItemExtraList::insert($insertData);

        if ($insert) {
            return __request(1, __('success_text'), url('vendor/products/addons/' . $itemId . '?isAjax=1'));
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
            'status' => 1
        ];

        $update = $this->baseRepo->update($id, $data, 'item_extra_list');

        if ($update) {
            return __request(1, __('success_text'), url('vendor/products/addons/' . $item_id . '?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }



    public function add_item_addons(Request $request)
    {
        try {
            $request->validate([
                'addon_name.*'   => 'required|string',
                'price'          => 'required|numeric|min:0',
                'max_select_qty' => 'nullable|integer|min:0',
                'image'          => 'nullable|string',
                'id'             => 'nullable|integer',
                'item_id'        => 'required|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return __request(0, $e->validator->errors()->first(), '');
        }

        try {
            return DB::transaction(function () use ($request) {

                $vendorId = __activeVendor('id');
                $item_id = $request->item_id;

                $data = [
                    'user_id'        => $this->userId,
                    'vendor_id'      => $vendorId,
                    'price'          => $request->price,
                    'max_select_qty' => $request->max_select_qty ?? 0,
                    'images'         => $request->image,
                    'thumb'          => $request->image,
                ];

                $addonId = null;

                if ($request->id) {
                    $addon = AddonLibrary::where('id', $request->id)
                        ->where('vendor_id', $vendorId)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $addon->update($data);
                    $addonId = $addon->id;
                } else {
                    $data['orders'] = AddonLibrary::getNextOrder($vendorId);

                    $addon = AddonLibrary::create($data);
                    $addonId = $addon->id;
                }

                if (is_array($request->addon_name) && !empty($addonId)) {
                    $langData = [];

                    foreach ($request->addon_name as $lang => $name) {
                        if (!empty($name)) {
                            $langData[$lang] = [
                                'addon_name' => $name
                            ];
                        }
                    }

                    if (!empty($langData)) {
                        $this->baseRepo->saveLanguageData(
                            $addonId,
                            'addon_library_id',
                            'vendor_addon_library_ln',
                            $langData
                        );
                    }
                }

                return __request(
                    1,
                    __('success_text'),
                    url('vendor/products/addons/' . $item_id . '?isAjax=1')
                );
            });
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return __request(0, __('Addon not found'), '');
        } catch (\Throwable $e) {
            return __request(0, $e->getMessage(), '');
        }
    }



    /*----------------------------------------------
            CATEGORY
    ----------------------------------------------*/

    public function category_list()
    {
        $data = [];
        $data['page_title'] = 'Categories';
        $data['page'] = 'products';
        $data['category_list'] = $this->vendorRepo->getVendorCategory($this->vendorId);

        return __mainContent('backend.products.category_list', $data);
    }



    public function add_category(Request $request)
    {
        try {
            $request->validate([
                'category_name.*' => 'required|string|max:255',
                'image'           => 'nullable|string',
                'id'              => 'nullable|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return __request(0, $e->validator->errors()->all(), '');
        }

        try {
            return DB::transaction(function () use ($request) {

                $vendorId = __activeVendor('id');

                $data = [
                    'user_id'   => $this->userId,
                    'vendor_id' => $vendorId,
                    'images'    => $request->image,
                    'thumb'     => $request->image,
                    'status'    => 1,
                ];

                $categoryId = null;

                if ($request->id) {
                    $category = Category::where('id', $request->id)
                        ->where('vendor_id', $vendorId)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $category->update($data);
                    $categoryId = $category->id;
                } else {
                    $data['orders'] = Category::getNextOrder($vendorId);

                    $category = Category::create($data);
                    $categoryId = $category->id;
                }

                if (is_array($request->category_name) && !empty($categoryId)) {
                    $langData = [];

                    foreach ($request->category_name as $lang => $name) {
                        if (!empty($name)) {
                            $langData[$lang] = [
                                'category_name' => $name
                            ];
                        }
                    }

                    if (!empty($langData)) {
                        $this->baseRepo->saveLanguageData(
                            $categoryId,
                            'category_id',
                            'vendor_category_list_ln',
                            $langData
                        );
                    }
                }

                return __request(
                    1,
                    __('success_text'),
                    url('vendor/products/categories?isAjax=1')
                );
            });
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return __request(0, __('Category not found'), '');
        } catch (\Throwable $e) {
            return __request(0, $e->getMessage(), '');
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

        $data['category_list'] = $this->vendorRepo->getVendorCategorywithSubcategory();
        $data['subcategory_list'] = $this->vendorRepo->getSubCategory();


        return __mainContent('backend.products.subcategory_list', $data);
    }


    /* ======================================
    Sub Category List Area ENd
    ======================================== */



    public function add_subcategory(Request $request)
    {
        try {
            $request->validate([
                'category_id'         => 'required|integer',
                'subcategory_name.*'  => 'required|string',
                'image'               => 'nullable|string',
                'id'                  => 'nullable|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return __request(0, $e->validator->errors()->all(), '');
        }

        try {
            return DB::transaction(function () use ($request) {

                $vendorId = __activeVendor('id');

                $data = [
                    'user_id'     => $this->userId,
                    'vendor_id'   => $vendorId,
                    'category_id' => $request->category_id,
                    'images'      => $request->image,
                    'thumb'       => $request->image,
                ];

                $subcategoryId = null;

                if ($request->id) {
                    $subcategory = SubCategory::where('id', $request->id)
                        ->where('vendor_id', $vendorId)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $subcategory->update($data);
                    $subcategoryId = $subcategory->id;
                } else {
                    $data['orders'] = SubCategory::getNextOrder($vendorId);

                    $subcategory = SubCategory::create($data);
                    $subcategoryId = $subcategory->id;
                }

                if (is_array($request->subcategory_name) && !empty($subcategoryId)) {
                    $langData = [];

                    foreach ($request->subcategory_name as $lang => $name) {
                        if (!empty($name)) {
                            $langData[$lang] = [
                                'subcategory_name' => $name
                            ];
                        }
                    }

                    if (!empty($langData)) {
                        $this->baseRepo->saveLanguageData(
                            $subcategoryId,
                            'subcategory_id',
                            'vendor_subcategory_list_ln',
                            $langData
                        );
                    }
                }

                return __request(
                    1,
                    __('success_text'),
                    url('vendor/products/subcategories?isAjax=1')
                );
            });
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return __request(0, __('Subcategory not found'), '');
        } catch (\Throwable $e) {
            return __request(0, $e->getMessage(), '');
        }
    }
    /* ======================================
    Add Sub Category Area ENd
    ======================================== */




    /* ======================================
    Allergen List Area
    ======================================== */


    public function allergen_list()
    {
        $data = [];
        $data['page_title'] = 'Allergens';
        $data['page'] = 'products';
        $data['allergen_list'] = $this->vendorRepo->getVendorAllergens($this->vendorId);

        return __mainContent('backend.products.allergen_list', $data);
    }


    public function add_allergen(Request $request)
    {
        try {
            $request->validate([
                'allergen_name.*' => 'required|string',
                'image'           => 'nullable|string',
                'id'              => 'nullable|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return __request(0, $e->validator->errors()->all(), '');
        }

        try {
            return DB::transaction(function () use ($request) {

                $vendorId = __activeVendor('id');

                $data = [
                    'user_id'   => $this->userId,
                    'vendor_id' => $vendorId,
                    'images'    => $request->image,
                    'thumb'     => $request->image,
                ];

                $allergenId = null;

                if ($request->id) {
                    $allergen = Allergen::where('id', $request->id)
                        ->where('vendor_id', $vendorId)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $allergen->update($data);
                    $allergenId = $allergen->id;
                } else {
                    $data['orders'] = Allergen::getNextOrder($vendorId);

                    $allergen = Allergen::create($data);
                    $allergenId = $allergen->id;
                }

                if (is_array($request->allergen_name) && !empty($allergenId)) {
                    $langData = [];

                    foreach ($request->allergen_name as $lang => $name) {
                        if (!empty($name)) {
                            $langData[$lang] = [
                                'allergen_name' => $name
                            ];
                        }
                    }

                    if (!empty($langData)) {
                        $this->baseRepo->saveLanguageData(
                            $allergenId,
                            'allergen_id',
                            'vendor_allergen_list_ln',
                            $langData
                        );
                    }
                }

                return __request(
                    1,
                    __('success_text'),
                    url('vendor/products/allergens?isAjax=1')
                );
            });
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return __request(0, __('Allergen not found'), '');
        } catch (\Throwable $e) {
            return __request(0, $e->getMessage(), '');
        }
    }
    /* ======================================
    Add Allergen Area ENd
    ======================================== */


    /* ======================================
    Addons List Area
    ======================================== */
    public function addons_library()
    {
        $data = [];
        $data['page_title'] = 'Addon Library';
        $data['page'] = 'products';
        $data['addon_list'] = $this->vendorRepo->getAddonLibrary();
        return __mainContent('backend.products.addon_library', $data);
    }




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

        try {
            return DB::transaction(function () use ($request) {

                $vendorId = __activeVendor('id');

                $data = [
                    'user_id'   => $this->userId,
                    'vendor_id' => $vendorId,
                    'price' => $request->price,
                    'max_select_qty' => $request->max_select_qty,
                    'images' => $request->image,
                    'thumb' => $request->image,
                    'created_at' => now()
                ];

                $addonLibraryId = null;

                if ($request->id) {
                    $addonLibrary = AddonLibrary::where('id', $request->id)
                        ->where('vendor_id', $vendorId)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $addonLibrary->update($data);
                    $addonLibraryId = $addonLibrary->id;
                } else {
                    $data['orders'] = AddonLibrary::getNextOrder($vendorId);

                    $addonLibrary = AddonLibrary::create($data);
                    $addonLibraryId = $addonLibrary->id;
                }

                if (is_array($request->addon_name) && !empty($addonLibraryId)) {
                    $langData = [];

                    foreach ($request->addon_name as $lang => $name) {
                        if (!empty($name)) {
                            $langData[$lang] = [
                                'addon_name' => $name
                            ];
                        }
                    }

                    if (!empty($langData)) {
                        $this->vendorRepo->saveLanguageData(
                            $addonLibraryId,
                            'addon_library_id',
                            'vendor_addon_library_ln',
                            $langData
                        );
                    }
                }

                return __request(
                    1,
                    __('success_text'),
                    url('vendor/products/addons-library?isAjax=1')
                );
            });
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return __request(0, __('Addon Library not found'), '');
        } catch (\Throwable $e) {
            return __request(0, $e->getMessage(), '');
        }
    }
    /* ======================================
    Add Addon Area ENd
    ======================================== */
}
