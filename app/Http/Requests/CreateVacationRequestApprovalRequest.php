<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Vacation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateVacationRequestApprovalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_approved'         => [
                'required',
                Rule::in([1, 0])
            ]
        ];
    }
}
