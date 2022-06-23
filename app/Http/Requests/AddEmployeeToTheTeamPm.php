<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEmployeeToTheTeamPm extends FormRequest
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
            'emailEmployee' => 'email:rfc,dns|exists:App\Models\User,email',
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
            'emailEmployee.email' => 'Enter email address !',
            'emailEmployee.exists' => 'Employee with this email does not exist !',
        ];
    }

}
