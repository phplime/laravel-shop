<?php

namespace App\Repositories;

use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PackageRepository
{
    protected $model;

    public function __construct(Package $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new package
     */
    public function create(array $data): object
    {
        return $this->model->create($data);
    }

    /**
     * Update existing package
     */
    public function update(int $id, array $data): object
    {
        $package = $this->model->findOrFail($id);
        $package->update($data);
        return $package->fresh();
    }

    /**
     * Find package by ID
     */
    public function find(int $id): ?object
    {
        return $this->model->find($id);
    }

    /**
     * Find package with features
     */
    public function findWithFeatures(int $id): ?object
    {
        return $this->model->with('feature_list')->find($id);
    }

    /**
     * Delete package
     */
    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Sync package features
     */


    public function syncFeatures(int $packageId, array $featureIds): void
    {
        // Delete old features
        DB::table('active_package_features')
            ->where('package_id', $packageId)
            ->delete();

        // Insert new features
        $features = collect($featureIds)->map(fn($fid) => [
            'package_id' => $packageId,
            'feature_id' => $fid,
            'status' => 1
        ]);

        DB::table('active_package_features')->insert($features->toArray());
    }


    /**
     * Delete all features for a package
     */
    public function deleteFeatures(int $packageId): void
    {
        DB::table('active_package_features')
            ->where('package_id', $packageId)
            ->delete();
    }

    /**
     * Get all packages
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get packages with pagination
     */
    public function paginate(int $perPage = 15)
    {
        return $this->model->paginate($perPage);
    }


    public function getPackageDetails__(array $filters = []): Collection
    {
        $query = DB::table('package_list as p')
            ->select(
                'p.*',
                DB::raw('GROUP_CONCAT(DISTINCT f.name SEPARATOR ", ") as feature_names'),
                DB::raw('GROUP_CONCAT(DISTINCT m.title SEPARATOR ", ") as module_names')
            )
            ->leftJoin('active_package_features as apf', 'p.id', '=', 'apf.package_id')
            ->leftJoin('feature_list as f', 'apf.feature_id', '=', 'f.id')
            // ✅ JSON-based join (MySQL 5.7+)
            ->leftJoin('module_list as m', function ($join) {
                $join->whereRaw("JSON_CONTAINS(p.module_ids, CAST(m.id AS JSON), '$')");
            })
            ->groupBy('p.id')
            ->orderByDesc('p.id');

        if (!empty($filters['package_type'])) {
            $query->where('p.package_type', $filters['package_type']);
        }

        return $query->get();
    }

    public function getPackageDetails(array $filters = []): Collection
    {
        $query = DB::table('package_list as p')
            ->select('p.*')
            ->orderByDesc('p.id');

        if (!empty($filters) && is_array($filters)) {
            foreach ($filters as $column => $value) {
                if (!is_null($value) && $value !== '') {
                    $query->where("p.$column", $value);
                }
            }
        }

        $packages = $query->get();

        if ($packages->isEmpty()) {
            return collect();
        }

        // Get all package IDs
        $packageIds = $packages->pluck('id');


        // ✅ Get all modules in one query (based on module_ids JSON)
        $allModuleIds = $packages->flatMap(function ($p) {
            return json_decode($p->module_ids ?? '[]', true) ?: [];
        })->unique()->values();


        $modules = DB::table('module_list')
            ->whereIn('id', $allModuleIds)
            ->select('id', 'title as name')
            ->get()
            ->keyBy('id');


        // ✅ Fetch features for all packages in one query
        $features = DB::table('active_package_features as apf')
            ->join('feature_list as f', 'apf.feature_id', '=', 'f.id')
            ->whereIn('apf.package_id', $packageIds)
            ->select('apf.package_id', 'f.id as feature_id', 'f.name')
            ->get()
            ->groupBy('package_id');


        return $packages->map(function ($p) use ($features, $modules) {
            $moduleIds = json_decode($p->module_ids ?? '[]', true) ?: [];

            $data = (array)$p;

            $data['feature_list'] = $features->get($p->id, collect())->map(fn($f) => [
                'id' => $f->feature_id,
                'name' => $f->name,
            ])->values();

            $data['module_list'] = collect($moduleIds)
                ->map(fn($id) => [
                    'id' => $id,
                    'name' => $modules[$id]->name ?? null,
                ])
                ->filter(fn($m) => !empty($m['name']))
                ->values();

            return $data;
        });



        // ✅ Combine everything
        // return $packages->map(function ($p) use ($features, $modules) {
        //     $moduleIds = json_decode($p->module_ids ?? '[]', true) ?: [];

        //     return [
        //         'id'            => $p->id,
        //         'package_name'  => $p->package_name,
        //         'slug'          => $p->slug,
        //         'store_limit'   => $p->store_limit,
        //         'price'         => $p->price,
        //         'previous_price'         => $p->previous_price,
        //         'duration'      => $p->duration,
        //         'package_type'  => $p->package_type,
        //         'features'      => $features->get($p->id, collect())->map(fn($f) => [
        //             'id' => $f->feature_id,
        //             'name' => $f->name,
        //         ])->values(),
        //         'modules'       => collect($moduleIds)->map(fn($id) => [
        //             'id' => $id,
        //             'name' => $modules[$id]->name ?? null,
        //         ])->filter(fn($m) => !empty($m['name']))->values(),
        //     ];
        // });
    }
}
