<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductApiUpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:75|unique:products,name,' . $this->product->id,
            'sku' => 'required|min:3|max:10|unique:products,sku,' . $this->product->id,
            'price' => 'required',
            'categories.*' => 'integer|exists:categories,id',
            'categories' => 'required|array',
            'brand' => 'required|integer|exists:brands,id',
            'images' => 'array|nullable',
            'images.*' => 'image',
        ];
    }

}
