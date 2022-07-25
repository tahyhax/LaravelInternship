<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\isRouteExist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PermissionApiUpdateRequest extends FormRequest
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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:permissions,name,' . $this->permission->id,
            'route_name' => ['required', 'min:5', 'max:75',
                Rule::unique('permissions', 'name')->ignore($this->permission->id), new isRouteExist],
            'roles' => 'array|nullable',
            'roles.*' => 'integer|exists:roles,id'

        ];
    }
}
