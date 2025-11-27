<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
    public function update(int $id, array $data, string $table): bool
    {
        $this->validateTable($table);
        $update =  DB::table($table)->where('id', $id)->update($data) > 0;
        return $update > 0 ? 1 : $id;
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
}
