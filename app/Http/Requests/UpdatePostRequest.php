<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => sprintf(
                'required|max:100|min:3|%s', Rule::unique('posts', 'title')->ignore($this->post)
            ),
            //note незнаю  как правильно оставлять валидацию  на slug или нет
            'slug' => sprintf(
                'required|max:100|min:3|%s', Rule::unique('posts', 'slug')->ignore($this->post)
            ),
            'body' => 'required',
        ];
    }
}
