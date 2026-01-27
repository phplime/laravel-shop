<?php

namespace App\Repositories;

use \App\Models\Allergen;
use \App\Traits\HasTranslations;
use App\Models\AddonLibrary;
use App\Models\Category;
use App\Models\ExtraTitleList;
use App\Models\Item;
use App\Models\ItemExtraList;
use App\Models\SubCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VendorRepository extends BaseRepository
{
    protected $vendorId;
    protected $userId;
    protected $cacheTtl = 3600;

    public function __construct()
    {
        $this->vendorId = __activeVendor('id');
        $this->userId = Auth::id();
    }

    // 🔑 Single cache key generator
    protected function cacheKey(string $type, $vendorId = null,  $userId = null): string
    {
        $vendorId = $this->vendorId($vendorId);
        $userId = $userId ?? $this->userId;
        return makeCacheKey($type, $vendorId, $userId);
    }

    // Helper to ensure we always have a valid vendor ID
    public function vendorId($vendorId = null)
    {
        return $vendorId ?: (__activeVendor('id') ?: $this->vendorId);
    }

    // 🔄 Generic re-cache helper (called by trait)
    public function reCache(string $type): void
    {
        $methodMap = [
            'categories'    => 'getVendorCategory',
            'subcategories' => 'getSubCategory',
            // Add more as needed: 'items' => 'getItems',
        ];

        $method = $methodMap[$type] ?? null;
        if ($method && method_exists($this, $method)) {
            $this->clearCache($type); // Clear first
            $this->{$method}(); // triggers Cache::remember → writes cache
        }
    }


    /**
     * Clear specific cache type
     */
    public function clearCache(string $type, $vendorId = null, $userId = null): void
    {
        Cache::forget($this->cacheKey($type, $vendorId, $userId));
    }

    /**
     * Clear all vendor-related caches
     */
    public function clearAllCache($vendorId = null, $userId = null): void
    {
        $types = ['categories', 'subcategories', 'dashboard_stats'];
        foreach ($types as $type) {
            $this->clearCache($type, $vendorId, $userId);
        }
    }

    /*----------------------------------------------
     GET NEXT ORDERS, ORders increment
    ----------------------------------------------*/
    public function getNextOrders($table = null, $vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);
        return DB::table($table)->where('vendor_id', $vendorId)
            ->max('orders') + 1;
    }


    public function selectByVendorId($table, $vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);
        return DB::table($table)->where('vendor_id', $vendorId)->get();
    }

    public function selectByVendorIdLn($table, $vendorId = null, $language = null)
    {
        $vendorId = $this->vendorId($vendorId);
        $items = DB::table($table)->where('vendor_id', $vendorId)->get();

        return HasTranslations::loadTableTranslations($items, $table, $language);
    }

    public function singleSelectByVendorId($id, $table, $vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);
        return DB::table($table)->where('vendor_id', $vendorId)->where('id', $id)->first();
    }

    /*----------------------------------------------
     Product
    ----------------------------------------------*/

    public function getVendorProducts($vendorId = null)
    {
        $categoryId = null;
        $vendorId = $this->vendorId($vendorId);
        if ($category = request('category')) {
            $normalized = strtolower(str_replace(['-', '_'], ' ', $category));

            $categoryId = DB::table('vendor_category_list_ln')
                ->where('category_name', $normalized)
                ->value('category_id');
        }

        $items = Item::query()
            ->with(['category', 'subcategory'])
            ->where('user_id', $this->userId)
            ->where('vendor_id', $vendorId)

            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when(request('subcategory'), fn($q) =>
            $q->where('subcategory_id', request('subcategory')))
            ->when(request('q'), fn($q) =>
            $q->where('name', 'like', '%' . request('q') . '%'))
            ->paginate(request('per_page', 2))
            ->withQueryString();

        Item::loadTranslations($items);

        return $items;
    }


    public function getProductById($id, $vendorId = null, $langauge = null)
    {
        $vendorId = $this->vendorId($vendorId);
        $item = Item::with(['category', 'subcategory'])
            ->where([
                ['id', '=', $id],
                ['user_id', '=', $this->userId],
                ['vendor_id', '=', $vendorId],
            ])
            ->first();

        if ($item) {
            Item::loadTranslations(collect([$item]), $langauge);
        }

        return $item;
    }

    /**
     * Get product by ID with item details and category/subcategory information
     */
    public function getProductByIdWithDetails($id, $vendorId = null, $language = null)
    {
        $vendorId = $this->vendorId($vendorId);

        $item = Item::query()
            ->with(['category', 'subcategory'])
            ->where('id', $id)
            ->where('user_id', $this->userId)
            ->where('vendor_id', $vendorId)
            ->first();

        if (!$item) {
            return null;
        }

        // Load translations
        Item::loadTranslations(collect([$item]), $language);

        if ($item->category) {
            Category::loadTranslations(collect([$item->category]), $language);
            // Keep only specific attributes
            $item->category->makeVisible(['id', 'category_name', 'slug']);
            $item->category->makeHidden(['created_at', 'updated_at', 'user_id', 'vendor_id']); // hide unwanted fields
        }

        if ($item->subcategory) {
            SubCategory::loadTranslations(collect([$item->subcategory]), $language);
            $item->subcategory->makeVisible(['id', 'subcategory_name', 'slug']);
            $item->subcategory->makeHidden(['created_at', 'updated_at', 'user_id', 'vendor_id']);
        }

        return $item;
    }

    /*----------------------------------------------
   Category
  ----------------------------------------------*/

    public function getVendorCategory($vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);

        $categories = Category::where('user_id', $this->userId)
            ->where('vendor_id', $vendorId)
            ->orderBy('orders', 'asc')
            ->get();

        Category::loadTranslations($categories);
        return $categories;
    }


    public function getCategoryByLanguage($vendorId = null, $language = null)
    {
        $vendorId = $this->vendorId($vendorId);
        $categories = Category::withCount('items as total_items')
            ->where('user_id', $this->userId)
            ->where('vendor_id', $vendorId)
            ->orderBy('orders', 'asc')
            ->get();

        Category::loadTranslations($categories, $language);

        return $categories;
    }


    public function getVendorCategorywithSubcategory($vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);

        $categories = Category::where('user_id', $this->userId)
            ->where('vendor_id', $vendorId)
            ->orderBy('orders', 'asc')
            ->get();

        $categories->load('subcategories');

        Category::loadTranslations($categories);
        return $categories;
    }



    /*----------------------------------------------
 SUBCATEGORY
----------------------------------------------*/

    public function getSubCategory($vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);

        $subcategories = SubCategory::where('user_id', $this->userId)
            ->where('vendor_id', $vendorId)
            ->orderBy('created_at', 'DESC')
            ->get();

        SubCategory::loadTranslations($subcategories);
        return $subcategories;
    }

    /*----------------------------------------------
     Allergens
    ----------------------------------------------*/
    public function getVendorAllergens($vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);
        $allergens = Allergen::where('vendor_id', $vendorId)
            ->where('status', 1)
            ->get();

        Allergen::loadTranslations($allergens);
        return $allergens;
    }


    //example without model
    public function getDashboardStats($vendorId = null)
    {
        $key = makeCacheKey('dashboard_stats', $vendorId);

        return setCache('dashboard_stats', function () use ($vendorId) {
            return DB::table('orders')
                ->where('vendor_id', $vendorId)
                ->selectRaw('COUNT(*) as total, SUM(total) as revenue')
                ->first();
        }, $vendorId, $this->userId);
    }


    /*----------------------------------------------
 Addon libaray
----------------------------------------------*/

    public function getAddonLibrary($vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);
        $addons = AddonLibrary::where('vendor_id', $vendorId)
            ->get();

        AddonLibrary::loadTranslations($addons);
        return $addons;
    }


    public function getAddonListByItemId($item_id, $vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);

        $extraTitleList = ExtraTitleList::where('item_id', $item_id)
            ->where('vendor_id', $vendorId)
            ->orderBy('orders', 'ASC')
            ->get();

        if ($extraTitleList->isEmpty()) {
            return collect();
        }

        ExtraTitleList::loadTranslations($extraTitleList);

        $extraTitleIds = $extraTitleList->pluck('id')->flatten();

        $extraList = ItemExtraList::with(['addonLibrary'])
            ->whereIn('extra_title_id', $extraTitleIds)
            ->where('vendor_id', $vendorId)
            ->where(function ($query) {
                $query->orWhereHas('addonLibrary', function ($q) {
                    $q->where('status', 1);
                });
            })
            ->orderBy('id', 'ASC')
            ->get();

        $addonLibraries = $extraList->pluck('addonLibrary')->filter();

        if ($addonLibraries->isNotEmpty()) {
            AddonLibrary::loadTranslations($addonLibraries);
        }

        // Group extras by extra_title_id for easy access
        $groupedExtras = $extraList->groupBy('extra_title_id');


        // Attach grouped extras to each title and format them
        foreach ($extraTitleList as $title) {
            $title->setRelation('extra_list', $groupedExtras->get($title->id, collect()));
        }

        return $extraTitleList;
    }




    public function getAddonListByItemId__($item_id, $vendorId = null)
    {
        $vendorId = $this->vendorId($vendorId);

        $extraTitleList = ExtraTitleList::where('item_id', $item_id)
            ->where('vendor_id', $vendorId)
            ->orderBy('orders', 'ASC')
            ->get();

        if ($extraTitleList->isEmpty()) {
            return collect();
        }

        ExtraTitleList::loadTranslations($extraTitleList);

        $extraTitleIds = $extraTitleList->pluck('id')->flatten();

        $extraList = ItemExtraList::with(['addonLibrary'])
            ->whereIn('extra_title_id', $extraTitleIds)
            ->where('vendor_id', $vendorId)
            ->where(function ($query) {
                $query->orWhereHas('addonLibrary', function ($q) {
                    $q->where('status', 1);
                });
            })
            ->orderBy('id', 'ASC')
            ->get();

        $addonLibraries = $extraList->pluck('addonLibrary')->filter();

        if ($addonLibraries->isNotEmpty()) {
            AddonLibrary::loadTranslations($addonLibraries);
        }

        // Group extras by extra_title_id for easy access
        $groupedExtras = $extraList->groupBy('extra_title_id');


        // Attach grouped extras to each title and format them
        foreach ($extraTitleList as $title) {
            $extras = $groupedExtras->get($title->id, collect());

            foreach ($extras as $extra) {
                if ($extra->addonLibrary) {
                    $extra->el_name = $extra->addonLibrary->name;
                    $extra->el_price = $extra->addonLibrary->price;
                    $extra->el_status = $extra->addonLibrary->status;
                    $extra->_extranames = $extra->addonLibrary->loadedTranslations ?? collect();
                } else {
                    $extra->_extranames = collect();
                }
            }

            $title->extra_list = $extras;
            $title->_names = $title->loadedTranslations;
            $title->names = $title->loadedTranslations;
        }

        dd($extraTitleList);

        return $extraTitleList;
    }



    /**
     * Update a single item inside a cached list (Avoids DB query)
     */
    public function updateCacheItem(string $type, $id, $column, $value, $vendorId = null)
    {
        $key = $this->cacheKey($type, $vendorId);

        if (Cache::has($key)) {
            $data = Cache::get($key);

            // If it's a collection, transform it
            if ($data instanceof \Illuminate\Support\Collection) {
                $data->transform(function ($item) use ($id, $column, $value) {
                    if ($item->id == $id) {
                        $item->$column = $value;
                    }
                    return $item;
                });

                // Save back to cache
                Cache::put($key, $data, $this->cacheTtl);
            }
        }
    }

    /*----------------------------------------------
     EXAMPLE
    ----------------------------------------------*/
    // public function getSubCategory($vendorId = null)
    // {
    //     $vendorId = $this->vendorId($vendorId);

    //     return setCache('subcategories', $vendorId, $this->userId, function () use ($vendorId) {
    //         $subcategories = SubCategory::where('user_id', $this->userId)
    //             ->where('vendor_id', $vendorId)
    //             ->orderBy('created_at', 'DESC')
    //             ->get();

    //         SubCategory::loadTranslations($subcategories);
    //         return $subcategories;
    //     });
    // }
}
