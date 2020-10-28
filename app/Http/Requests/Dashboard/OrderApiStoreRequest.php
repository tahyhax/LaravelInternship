<?php

namespace App\Http\Requests\Dashboard;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class OrderApiStoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => 'NTR-' . Carbon::now()->format('mdYHi-s'),
        ]);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
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
            'orderItems' => 'required|array',
        ];
    }
}
