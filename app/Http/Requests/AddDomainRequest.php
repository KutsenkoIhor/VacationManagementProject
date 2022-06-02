<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDomainRequest extends FormRequest
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
            'name' => 'required|max:255|unique:allowed_domains,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A Domain field is required',
            'name.max' => 'The Domain must not be greater than 255 characters',
            'name.unique' => 'This Domain exist',
        ];
    }
}
