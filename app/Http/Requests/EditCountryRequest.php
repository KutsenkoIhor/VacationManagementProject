<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCountryRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:App\Models\Country,title,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A Country field is required',
            'title.string' => 'A Country field must be string',
            'title.unique' => 'This Country exists',
            'title.max' => 'The Country name must not be greater than 255 characters',
        ];
    }
}
