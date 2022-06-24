<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPublicHolidayRequest extends FormRequest
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
            'title' => 'string|max:255',
            'country_id' => 'required|exists:App\Models\Country,id',
            'date' => 'required|date|after:today',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A Holiday field is required',
            'title.string' => 'A Holiday field must be string',
            'title.max' => 'The Holiday name must not be greater than 255 characters',
            'country_id.required' => 'The Country of Holiday is required',
            'country_id.exists' => 'This Country does not exist',
        ];
    }
}
