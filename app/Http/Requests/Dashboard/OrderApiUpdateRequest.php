<?php

namespace App\Http\Requests\Dashboard;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class OrderApiUpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => 'NTR-' . Carbon::now()->format('mdYHi-s'),
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
            'address' => 'required|min:10|max:255',
            'user' => 'required|integer|exists:users,id',
            'paymentMethods' => 'integer|exists:payment_methods,id',
            'orderItems.*.id' => 'integer|exists:products,id',
            'orderItems.*.qty' => 'required|integer|min:1',
            'orderItems' => 'required|array',

        ];
    }
}
