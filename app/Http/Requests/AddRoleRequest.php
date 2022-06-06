<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRoleRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:roles,name',
            'vacations' => 'required|integer|max:255',
            'personal_days' => 'required|integer|max:255',
            'sick_days' => 'required|integer|max:255',
            'permissions' => 'required',
            'permissions.*' => 'required|integer|exists:permissions,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A Role field is required',
            'name.string' => 'A Role field must be string',
            'name.unique' => 'This Role exists',
            'name.max' => 'The Role name must not be greater than 255 characters',
            'vacations.required' => 'The Vacations days is required',
            'personal_days.required' => 'The Personal days is required',
            'sick_days.required' => 'The Sick days is required',
            'vacations.integer' => 'The Vacations days field must be an integer',
            'personal_days.integer' => 'The Personal days field must be an integer',
            'sick_days.integer' => 'The Sick days field must be an integer',
            'vacations.max' => 'The Vacations days must not be greater than 255 characters',
            'personal_days.max' => 'The Personal days must not be greater than 255 characters',
            'sick_days.max' => 'The Sick days must not be greater than 255 characters',
            'permissions.required' => 'Must have at least one permission',
        ];
    }
}
