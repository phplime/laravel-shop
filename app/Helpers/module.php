<?php

use App\Services\ModuleAccessService;

function hasFeature(string $slug, ?int $vendorId = null): bool
{
    return app(ModuleAccessService::class)
        ->has('package_features', $slug, $vendorId);
}

function hasModuleFeature(string $slug, ?int $vendorId = null): bool
{
    return app(ModuleAccessService::class)
        ->has('features', $slug, $vendorId);
}

function hasOrderType(string $slug, ?int $vendorId = null): bool
{
    return app(ModuleAccessService::class)
        ->has('order_types', $slug, $vendorId);
}
