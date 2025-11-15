<?php

namespace App\Http\Requests;

use App\Support\Make;
use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'package_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'package_type' => 'required|string',
            'price' => 'nullable|min:0',
            'previous_price' => 'nullable|min:0',
            'duration' => 'nullable',
            'store_limit' => 'nullable|integer|min:1',
            'feature_id' => 'nullable|array',
            'feature_id.*' => 'nullable',
            'module_ids' => 'nullable',
            'module_ids.*' => 'nullable',
        ];
    }

    protected function prepareForValidation()
    {
        // Clean/transform data before validation
        if ($this->filled('slug')) {
            $this->merge([
                'slug' => Make::slug($this->slug),
            ]);
        }
    }
}
