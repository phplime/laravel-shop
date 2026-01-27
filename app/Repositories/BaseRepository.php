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
        'vendor_category_list',
        'vendor_category_list_ln',
        'settings',
        'vendor_subcategory_list_ln',
        'vendor_subcategory_list',
        'vendor_addon_library',
        'vendor_addon_library_ln',
        'vendor_allergen_list',
        'vendor_allergen_list_ln',
        'vendor_tax_list',
        'vendor_item_list',
        'vendor_item_list_ln',
        'vendor_extra_title_list',
        'vendor_extra_title_list_ln',
        'item_extra_list',
        'vendor_slider_list',
        'customer_list',
        'vendor_page_list',
        'vendor_page_list_ln',
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
        } else {
            $data[$check_column] = $check_id;
            $data['language'] = $lang;
            $this->create($data, $table);
        }
    }



    public function get_lang_data($id, $columnName, $table)
    {
        return DB::table($table)->where($columnName, $id)->get();
    }






    public function select_by_vendor_id($table)
    {
        return DB::table($table)->where('vendor_id', __activeVendor('id'))->get();
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
        } else {
            $item_tax = 0;
        }

        return $item_tax;
    }






    public function get_ln_data($table, $check_id, $isActive = false)
    {
        $lnTable = $table . '_ln';


        $query = DB::table($table)->where('user_id', Auth::id())->where('vendor_id',  __activeVendor('id'));

        if ($isActive === true) {
            $query->where('status', 1);
        }

        $finalQuery = $query->get();

        foreach ($finalQuery as $key => $value) {
            $finalQuery[$key]->ln_data = DB::table($lnTable)->where($check_id, $value->id)->where('language', app()->getLocale())->get();
        }

        return $finalQuery;
    }




    public function get_page_ln_data_by_slug(string $table, string $check_id, ?string $slug = null, ?string $language = null)
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
            $item->_names = $this->get_ln($item->id, $check_id, $lnTable, $language);
        }

        return !empty($slug) ? ($result->first() ?? null) : $result;
    }


    public function get_ln(int $id, string $column_name, string $table, ?string $language = null)
    {
        $query = DB::table($table)->where($column_name, $id);

        if (!empty($language)) {
            $query->where('language', $language);
        }

        return $query->get();
    }

    /**
     * Efficiently save (insert or update) language data.
     *
     * @param int $insertId The ID of the parent record.
     * @param string $foreignKey The foreign key column in the translation table.
     * @param string $translationTable The name of the translation table.
     * @param array $languageData Data keyed by language code. Example: ['en' => ['name' => 'Val'], 'bn' => ['name' => 'Val']]
     */
    public function saveLanguageData($insertId, $foreignKey, $translationTable, $languageData)
    {
        foreach ($languageData as $lang => $data) {
            DB::table($translationTable)->updateOrInsert(
                [$foreignKey => $insertId, 'language' => $lang],
                $data
            );
        }
    }
}
