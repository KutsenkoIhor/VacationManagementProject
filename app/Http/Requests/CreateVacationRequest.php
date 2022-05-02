<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Vacation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateVacationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '_token'  => 'required|string',
//            'start_date'     => 'required|date|after_or_equal:now', //TODO fix
            'start_date'     => 'required|date_format:"Y-m-d"',
            'end_date'       => 'required|date_format:"Y-m-d"|after:start_date',
            'type'           => [
                'required',
                Rule::in([Vacation::TYPE_VACATIONS, Vacation::TYPE_PERSONAL_DAYS, Vacation::TYPE_SICK_DAYS])
            ]
        ];
    }
}