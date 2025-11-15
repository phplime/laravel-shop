<?php

namespace App\Services;

use App\Repositories\PackageRepository;
use Illuminate\Support\Facades\DB;

class PackageService
{
    protected $packageRepo;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepo = $packageRepo;
    }

    /**
     * Save or update a package with its features
     */
    public function savePackage(array $data, ?int $packageId = null): object
    {


        return DB::transaction(function () use ($data, $packageId) {
            // Prepare package data
            $packageData = $this->preparePackageData($data);

            // Create or update package
            if ($packageId) {
                $package = $this->packageRepo->update($packageId, $packageData);
            } else {
                $package = $this->packageRepo->create($packageData);
            }

            // Sync features if provided
            if (!empty($data['feature_id'])) {
                $this->packageRepo->syncFeatures($package->id, $data['feature_id']);
            }

            return $package;
        });
    }

    /**
     * Prepare package data for storage
     */
    protected function preparePackageData(array $data): array
    {
        return [
            'package_name' => $data['package_name'],
            'slug' => $data['slug'],
            'package_type' => $data['package_type'],
            'price' => $data['price'] ?? 0,
            'previous_price' => $data['previous_price'] ?? 0,
            'duration' => $data['duration'] ?? 1,
            'store_limit' => $data['store_limit'] ?? 1,
            'is_private' => !empty($data['is_private']) ? 1 : 0,
            'module_ids' => json_encode($data['module_ids'] ?? []),
        ];
    }

    /**
     * Get package with features
     */
    public function getPackageWithFeatures(int $packageId): ?object
    {
        return $this->packageRepo->findWithFeatures($packageId);
    }


    public function getPackageDetails(array $filters = [])
    {
        return $this->packageRepo->getPackageDetails($filters);
    }

    /**
     * Delete package
     */
    public function deletePackage(int $packageId): bool
    {
        return DB::transaction(function () use ($packageId) {
            $this->packageRepo->deleteFeatures($packageId);
            return $this->packageRepo->delete($packageId);
        });
    }
}
