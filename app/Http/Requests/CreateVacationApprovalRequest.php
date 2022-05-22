<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Vacation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateVacationApprovalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
//            'number_of_days' => 'required|integer',
            'status'         => [
                'required',
                Rule::in([Vacation::STATUS_APPROVED, Vacation::STATUS_DENIED])
            ]
        ];
    }
}
