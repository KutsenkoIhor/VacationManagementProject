<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\VacationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVacationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
//            'start_date'     => 'required|date|after_or_equal:now', //TODO fix
//            'start_date'     => 'required|date_format:"Y-m-d"',
//            'end_date'       => 'required|date_format:"Y-m-d"|after:start_date',
//            'type'           => [
//                'required',
//                Rule::in([VacationRequest::TYPE_VACATIONS, VacationRequest::TYPE_PERSONAL_DAYS, VacationRequest::TYPE_SICK_DAYS])
//            ]
        ];
    }
}
