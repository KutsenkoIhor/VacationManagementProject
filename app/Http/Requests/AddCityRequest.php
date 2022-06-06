<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCityRequest extends FormRequest
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
            'title' => 'string|max:255|unique:App\Models\City',
            'country_id' => 'required|exists:App\Models\Country,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A City field is required',
            'title.string' => 'A City field must be string',
            'title.unique' => 'This City exists',
            'title.max' => 'The City name must not be greater than 255 characters',
            'country_id.required' => 'The Country of City is required',
            'country_id.exists' => 'This Country does not exist',
        ];
    }
}
