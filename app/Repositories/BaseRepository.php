<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class BaseRepository
{
    // Whitelist allowed tables (security!)
    private array $allowedTables = [
        'users',
        'products',
        'countries',
        'categories',
        'items',
        'language_list',
        'language_data',
        'country_list',
        'feature_list',
        'package_list',
        'module_feature_list',
        'order_type_list',
        'module_list',
        // Add your 10+ tables here
    ];

    private function validateTable(string $table): void
    {
        if (!in_array($table, $this->allowedTables)) {
            throw new \InvalidArgumentException("Access to table '{$table}' is not allowed.");
        }
    }

    /**
     * Paginate records from any allowed table.
     *
     * @param int $perPage
     * @param string $table
     * @param array $filters (e.g., ['active' => 1, 'country_id' => 5])
     * @param array $columns
     * @param string $orderBy
     * @param string $direction
     * @return LengthAwarePaginator
     */
    public function paginate(
        string $table,
        int $perPage = 15,
        array $filters = [],
        array $columns = ['*'],
        array|string|null $orderBy = ['id' => 'asc']
    ): LengthAwarePaginator {
        $this->validateTable($table);

        $query = DB::table($table)->select($columns);

        // 🔹 Apply filters safely
        foreach ($filters as $column => $value) {
            if (!is_null($value) && $value !== '') {
                $query->where($column, $value);
            }
        }

        // 🔹 Handle ordering
        if ($orderBy) {
            if (is_string($orderBy)) {
                // Example: 'id'
                $query->orderBy($orderBy, 'asc');
            } elseif (is_array($orderBy)) {
                // Example: ['id' => 'desc', 'name' => 'asc']
                foreach ($orderBy as $column => $direction) {
                    $query->orderBy($column, strtolower($direction) === 'desc' ? 'desc' : 'asc');
                }
            }
        } else {
            // Fallback if orderBy is null
            $query->orderBy('id', 'asc');
        }

        // 🔹 Return paginated result
        return $query->paginate($perPage);
    }



    public function get_all_by_id(
        int $perPage = 15,
        string $table,
        array $filters = [],
        array $columns = ['*'],
        string $orderBy = 'id',
        string $direction = 'asc'
    ): LengthAwarePaginator {
        $this->validateTable($table);

        $query = DB::table($table)->select($columns);

        foreach ($filters as $column => $value) {
            if ($value !== null && $value !== '') {
                $query->where($column, $value);
            }
        }

        return $query->orderBy($orderBy, $direction)->paginate($perPage);
    }

    /**
     * Get a single record by ID.
     */
    public function find(int $id, string $table, array $columns = ['*'])
    {

        $this->validateTable($table);
        return DB::table($table)->select($columns)->find($id);
    }

    /**
     * Insert a new record.
     */
    public function create(array $data, string $table): int
    {
        $this->validateTable($table);
        return DB::table($table)->insertGetId($data);
    }

    /**
     * Update a record.
     */
    public function update(int $id, array $data, string $table)
    {
        $this->validateTable($table);
        $update =  DB::table($table)->where('id', $id)->update($data) > 0;
        return $id;
    }


    public function updateWhere(array $data, array $where, string $table): int|array|null
    {
        $this->validateTable($table);

        $ids = DB::table($table)
            ->where($where)
            ->pluck('id')
            ->all();

        if (empty($ids)) {
            return null;
        }

        DB::table($table)
            ->whereIn('id', $ids)
            ->update($data);
        return match (count($ids)) {
            1 => $ids[0],
            default => $ids,
        };
    }
    /**
     * Delete a record.
     */
    public function delete(int $id, string $table): bool
    {
        $this->validateTable($table);
        return DB::table($table)->where('id', $id)->delete() > 0;
    }

    /**
     * Get all records (use cautiously!).
     */
    public function all(
        string $table,
        array|string|null $orderBy = null,
        array $columns = ['*'],
        int|bool $lazy = true, // Default to lazy loading
        array $filters = []     // e.g., ['en' => 'search', 'keyword' => 'search']
    ) {
        $query = DB::table($table)->select($columns);

        // Apply dynamic filters
        if (!empty($filters)) {
            $query->where(function ($q) use ($filters) {
                foreach ($filters as $column => $value) {
                    if (!empty($value)) {
                        $q->orWhere($column, 'like', "%{$value}%");
                    }
                }
            });
        }

        // Apply order by
        if ($orderBy) {
            if (is_string($orderBy)) {
                $query->orderBy($orderBy, 'asc');
            } elseif (is_array($orderBy)) {
                foreach ($orderBy as $column => $direction) {
                    $query->orderBy($column, strtolower($direction) === 'desc' ? 'desc' : 'asc');
                }
            }
        } else {
            $query->orderBy('id', 'asc');
        }

        // Lazy loading / chunking
        if ($lazy === true) {
            return $query->lazy(); // default 1000 chunk size
        } elseif (is_int($lazy) && $lazy > 0) {
            return $query->lazy($lazy); // custom chunk size
        } elseif ($lazy === false) {
            return $query->get(); // fetch all
        }

        return $query->get();
    }


    public function getWhere(array|string $column, array|string|int $value, string $table, array $columns = ['*'])
    {
        $this->validateTable($table);
        return DB::table($table)->select($columns)->where($column, $value)->first();
    }


    public function getPaginatedData(int $perPage = 15, $table): LengthAwarePaginator
    {
        return DB::table($table)->paginate($perPage);
    }



    /**
     * Delete by condition(s)
     */
    public function deleteBy(string $table, array|string $column, $value = null)
    {
        $query = DB::table($table);
        if (is_array($column)) {
            // multiple conditions
            $query->where($column);
        } else {
            $query->where($column, $value);
        }

        return $query->delete();
    }

    /**
     * Insert multiple records
     */
    public function insertAll(array $data, string $table)
    {
        if (empty($data)) return false;

        try {
            return DB::table($table)->insert($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function get_vendor_language_list()
    {
        return DB::table('language_list as l')
            ->join('country_list as c', 'c.id', '=', 'l.country_id')
            ->select('l.*', 'c.iso2')
            ->where('l.status', 1)
            ->get();
    }



    public function get_category_by_select_ln_data()
    {
        $query = DB::table('vendor_category_list')
            ->where('user_id', Auth::id())
            ->where('vendor_id', __activeVendor('id'))
            ->orderBy('created_at', 'DESC')
            ->get();

        // Get Lang Category name
        foreach ($query as $key => $value) {
            $query[$key]->category_names = DB::table('vendor_category_list_ln')->where('category_id', $value->id)->where('language', app()->getLocale())->value('category_name');
        }

        // Count Category Items
        foreach ($query as $key => $cat) {
            $items = DB::table('vendor_item_list')->where('category_id', $cat->id)->get();
            $query[$key]->total_items = $items->count();
        }

        return $query;
    }



    public function get_vendor_category($user_id)
    {
        $query = DB::table('vendor_category_list')
            ->where('user_id', $user_id)
            ->where('vendor_id', __activeVendor('id'))
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($query as $key => $value) {
            $query[$key]->category_names = DB::table('vendor_category_list_ln')->where('category_id', $value->id)->get();
        }

        return $query;
    }


    public function get_country_list()
    {
        $query = DB::table('country_list')->get();

        return $query;
    }




    public function check_existing_language_datas($check_id, $check_column, $lang, $data, $table)
    {
        $query = DB::table($table)->where($check_column, $check_id)->where('language', $lang)->first();

        if ($query) {
            $this->update($query->id, $data, $table);
        }else
        {
            $data[$check_column] = $check_id;
            $data['language'] = $lang;
            $this->create($data, $table);
        }
    }



    public function get_lang_data($id, $columnName, $table)
    {
        return DB::table($table)->where($columnName, $id)->get();
    }



    public function get_subcategories($user_id)
    {
        $categories = DB::table('vendor_category_list as c')
            ->where('c.user_id', $user_id)
            ->where('c.vendor_id', __activeVendor('id'))
            ->select('c.id as cat_id', 'c.thumb as category_img')
            ->orderBy('c.created_at', 'DESC')
            ->get();

        foreach ($categories as $cat) {
            $cat->subcategory = DB::table('vendor_subcategory_list')
                ->where('category_id', $cat->cat_id)
                ->get();
        }

        $categories = $categories->filter(function ($item) {
            return $item->subcategory->count() > 0;
        })->values();

        return $categories;
    }



    public function select_by_vendor_id($table)
    {
        return DB::table($table)->where('vendor_id', __activeVendor('id'))->get();
    }



    public function get_vendor_products()
    {
        $cat_id = null;
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $get_name = strtolower(str_replace(['-', '_', ' '], ' ', $_GET['category']));
            $cat_id = DB::table('vendor_category_list_ln')->where('category_name', $get_name)->value('category_id');
        }

        $query = DB::table('vendor_item_list')->where('user_id', Auth::id())->where('vendor_id', __activeVendor('id'));

        if(!empty($cat_id)){
            $query->where('category_id', $cat_id);
        }

        $items = $query->get();


        foreach ($items as $key => $value) {
            $items[$key]->item_names = $this->get_lang_data($value->id, 'item_id', 'vendor_item_list_ln');
        }

        return $items;
    }



    public function get_vendor_product_id($id)
    {
        $item = DB::table('vendor_item_list')
        ->where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()],
            ['vendor_id', '=', __activeVendor('id')],
        ])
        ->first();

        if (!$item) {
            return null;
        }

        $item->item_details = $this->get_lang_data($id, 'item_id', 'vendor_item_list_ln');

        return $item;
    }



    public function get_variants_by_item_id($item_id)
    {
        return $this->get_lang_data($item_id, 'item_id', 'vendor_item_list_ln');
    }


    public function get_item_tax($item_id)
    {
        $item = $this->find($item_id, 'vendor_item_list');
        $taxs = isset($item->tax) && !empty($item->tax) ? json_decode($item->tax) : [];

        if (!empty($taxs)) {
            $item_tax = DB::table('vendor_tax_list as t')->whereIn('t.id', $taxs)->where('t.status', 1)->select('t.*')->get();
        }else{
            $item_tax = 0;
        }

        return $item_tax;
    }


    public function get_my_addons_by_item_id($item_id)
    {
        $addon_title = DB::table('vendor_extra_title_list')
                        ->where([
                            ['vendor_id', '=', __activeVendor('id')],
                            ['user_id', '=', Auth::id()],
                            ['item_id', '=', $item_id],
                        ])->get();


        foreach ($addon_title as $key => $value) {
            $query = DB::table('item_extra_list as ex')
                        ->join('vendor_addon_library as l', 'l.id', '=', 'ex.addon_id', 'left')
                        ->where('ex.item_id', $item_id)
                        ->where('ex.extra_title_id', $value->id)
                        ->select('ex.*','ex.id as item_extra_id','l.price','l.max_select_qty','ex.price as item_extra_price','ex.max_select_qty as item_extra_max_select_qty')
                        ->get();

            foreach ($query as $key1 => $value) {
                $query[$key1]->extranames = DB::table('vendor_addon_library_ln')->where('addon_id', $value->addon_id)->get();
            }

            $addon_title[$key]->extra_list = $query;
        }

        foreach ($addon_title as $key => $value) {
            $addon_title[$key]->names = DB::table('vendor_extra_title_list_ln')->where('extra_title_id', $value->id)->get();
        }

        return $addon_title;
    }



    public function get_ln_data($table, $check_id, $isActive = false)
    {
        $lnTable = $table.'_ln';


        $query = DB::table($table)->where('user_id', Auth::id())->where('vendor_id',  __activeVendor('id'));

        if ($isActive === true ) {
            $query->where('status', 1);
        }

        $finalQuery = $query->get();

        foreach ($finalQuery as $key => $value) {
            $finalQuery[$key]->ln_data = DB::table($lnTable)->where($check_id, $value->id)->where('language', app()->getLocale())->get();
        }

        return $finalQuery;
    }




    public function get_page_ln_data_by_slug(string $table, string $check_id, ?string $slug = null, ?string $language = null )
    {
        $lnTable = $table . '_ln';

        $query = DB::table($table)
            ->where('vendor_id', __activeVendor())
            ->where('user_id', Auth::id());

        if (!empty($slug)) {
            $query->where('slug', $slug);
        }

        $result = $query->get();

        foreach ($result as $item) {
            $item->_names = $this->get_ln($item->id, $check_id, $lnTable, $language );
        }

        return !empty($slug) ? ($result->first() ?? null) : $result;
    }


    public function get_ln( int $id, string $column_name, string $table, ?string $language = null )
    {
        $query = DB::table($table) ->where($column_name, $id);

        if (!empty($language)) {
            $query->where('language', $language);
        }

        return $query->get();
    }



}
