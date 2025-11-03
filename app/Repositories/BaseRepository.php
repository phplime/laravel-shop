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
        return DB::table($table)->where('id', $id)->update($data) > 0;
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
    public function all(string $table, array $columns = ['*'])
    {
        $this->validateTable($table);
        return DB::table($table)->select($columns)->get();
    }

    public function getPaginatedData(int $perPage = 15, $table): LengthAwarePaginator
    {
        return DB::table($table)->paginate($perPage);
    }
}
