<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.product.edit', $this->product);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'sku' => ['sometimes', 'string'],
            'name' => ['sometimes', 'string'],
            'slug' => ['sometimes', Rule::unique('products', 'slug')->ignore($this->product->getKey(), $this->product->getKeyName()), 'string'],
            'description' => ['nullable', 'string'],
            'cover' => ['nullable', 'string'],
            'quantity' => ['sometimes', 'integer'],
            'price' => ['sometimes', 'numeric'],
            'status' => ['sometimes', 'integer'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
