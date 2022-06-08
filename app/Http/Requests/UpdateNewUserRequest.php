<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewUserRequest extends FormRequest
{
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
            'firstName' => 'max:255|required',
            'lastName' => 'max:255|required',
            'email' => 'email:rfc,dns',
            'vacationDays' => 'numeric|min:0|max:365',
            'sickDays' => 'numeric|min:0|max:365',
            'personalDays' => 'numeric|min:0|max:365',
            'roles' => 'required'
        ];
    }

    /**
     * Get error messages for specific validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'roles.required' => 'Choose a role !',
            'email.email' => 'Enter email address !',
            'firstName.required' => 'Enter first name !',
            'lastName.required' => 'Enter last name !',
        ];
    }
}
