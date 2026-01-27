<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait HasCacheable
{
    /**
     * Auto-register event listeners on model boot.
     */
    public static function bootHasCacheable()
    {
        static::saved(fn($model) => $model->clearAndRestoreCache());
        static::deleted(fn($model) => $model->clearCache());
    }

    /**
     * Clear cache for this model's type + vendor + user.
     */
    public function clearCache(): void
    {
        $key = $this->getCacheKey();
        Cache::forget($key);
    }

    /**
     * Clear and re-warm the cache using VendorRepository.
     */
    public function clearAndRestoreCache(): void
    {
        $this->clearCache();

        try {
            $repo = app(\App\Repositories\VendorRepository::class);
            $type = $this->getCacheType();
            $repo->reCache($type, $this->user_id);
        } catch (\Throwable $e) {
            // Fail silently in production; cache will rebuild on next read
            // \Log::debug("Cache re-warm skipped: {$e->getMessage()}");
        }
    }

    /**
     * 🔑 Override in model: e.g., 'categories', 'subcategories'
     */
    abstract protected function getCacheType(): string;

    /**
     * Generate cache key: vendor_{type}:vendor_id:user_id
     */
    protected function getCacheKey(): string
    {
        return "vendor_{$this->getCacheType()}:{$this->vendor_id}:user_{$this->user_id}";
    }
}
