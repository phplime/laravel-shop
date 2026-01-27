<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait HasTranslations
{
    protected $loadedTranslations = null;

    /**
     * Get the translation table name.
     */
    public function getTranslationTable()
    {
        return $this->getTable() . '_ln';
    }

    /**
     * Get the foreign key for the translation table.
     */
    public function getTranslationForeignKey()
    {
        // vendor_item_list -> item_id
        // vendor_category_list -> category_id
        return str_replace(['vendor_', '_list'], '', $this->getTable()) . '_id';
    }

    /**
     * Fetch and cache all translations for this model instance.
     */
    public function getTranslations()
    {
        if ($this->loadedTranslations === null) {
            $this->loadedTranslations = DB::table($this->getTranslationTable())
                ->where($this->getTranslationForeignKey(), $this->id)
                ->get();
        }
        return $this->loadedTranslations;
    }

    /**
     * Bulk load translations for a collection of models to avoid N+1.
     */
    public static function loadTranslations($models, $language = null)
    {
        if ($models->isEmpty()) return;

        $instance = new static;

        $table = $instance->getTranslationTable();

        $foreignKey = $instance->getTranslationForeignKey();
        $ids = $models->pluck('id')->toArray();

        $query = DB::table($table)->whereIn($foreignKey, $ids);

        if ($language) {
            $query->where('language', $language);
        }

        $allTranslations = $query->get()->groupBy($foreignKey);

        foreach ($models as $model) {
            $model->loadedTranslations = $allTranslations->get($model->id) ?? collect();
        }
    }

    /**
     * Static helper to load translations for raw DB::table results (stdClass objects)
     */
    public static function loadTableTranslations($items, $table, $language = null)
    {
        if ($items->isEmpty()) {
            return $items;
        }

        // Determine translation table and foreign key
        $translationTable = $table . '_ln';
        $foreignKey = str_replace(['vendor_', '_list'], '', $table) . '_id';

        // Fetch translations
        $ids = $items->pluck('id')->toArray();
        $translations = DB::table($translationTable)
            ->whereIn($foreignKey, $ids)
            ->get()
            ->groupBy($foreignKey);

        // Attach translations to items
        foreach ($items as $item) {
            $itemTranslations = $translations->get($item->id) ?? collect();

            // Attach specific localized fields based on current locale or requested language
            $targetLang = $language ?: app()->getLocale();
            $translation = $itemTranslations->firstWhere('language', $targetLang);

            if ($translation) {
                // Merge translation properties into the item object
                foreach ($translation as $key => $value) {
                    if (!in_array($key, ['id', 'language', $foreignKey, 'created_at', 'updated_at'])) {
                        $item->$key = $value;
                    }
                }
            }

            // Also attach all translations if needed for multi-language editing
            $item->_names = $itemTranslations;
        }

        return $items;
    }

    /**
     * Get translation for a specific language or current locale.
     */
    public function translate($language = null)
    {
        $language = $language ?: app()->getLocale();
        return $this->getTranslations()->where('language', $language)->first();
    }

    /**
     * Override Eloquent's getAttribute to handle localized fields.
     */
    public function getAttribute($key)
    {
        // 1. Handle legacy property names used in old views - return localized string
        if (in_array($key, ['item_names', 'category_names', 'subcategory_names', 'item_details', 'category_details'])) {
            return $this->getTranslationAttribute($this->getNameField());
        }

        // 2. Check if the attribute exists on the main model or has a mutator
        $attribute = parent::getAttribute($key);

        // If the attribute exists on the model, return it
        if ($attribute !== null || array_key_exists($key, $this->attributes) || $this->hasGetMutator($key)) {
            return $attribute;
        }

        // 3. List of common localized attributes to check in the _ln table
        $localizedAttributes = ['category_name', 'subcategory_name', 'title', 'description', 'variant_name', 'variants', 'addon_name'];

        if (in_array($key, $localizedAttributes)) {
            return $this->getTranslationAttribute($key);
        }

        // 4. Handle generic 'name' attribute
        if ($key === 'name') {
            return $this->getTranslationAttribute($this->getNameField());
        }

        return $attribute;
    }

    protected function getNameField()
    {
        $table = $this->getTable();
        if (str_contains($table, 'category')) return 'category_name';
        if (str_contains($table, 'subcategory')) return 'subcategory_name';
        if (str_contains($table, 'item')) return 'title';
        if (str_contains($table, 'addon')) return 'addon_name';
        return 'name';
    }

    public function getTranslationAttribute($attribute, $language = null)
    {
        $translation = $this->translate($language);
        return $translation ? $translation->$attribute : null;
    }
}
