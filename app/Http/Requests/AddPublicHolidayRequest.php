<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPublicHolidayRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'countries' => 'required',
            'countries.*' => 'required|integer|exists:countries,id',
            'date' => 'required|date|after:today',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A Holiday field is required',
            'title.string' => 'A Holiday field must be string',
            'title.max' => 'The Holiday name must not be greater than 255 characters',
            'countries.required' => 'The Country of Holiday is required',
            'countries.exists' => 'This Country does not exist',
        ];
    }
}
