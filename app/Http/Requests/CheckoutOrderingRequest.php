<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutOrderingRequest extends FormRequest
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
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'first_name' => 'required',
            'last_name' => 'required',
            'paymentMethod' => 'integer|exists:payment_methods,id',
        ];
    }
}
