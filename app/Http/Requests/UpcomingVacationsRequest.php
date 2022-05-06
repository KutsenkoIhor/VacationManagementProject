<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpcomingVacationsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start_date'     => 'date_format:"Y-m-d"',
            'end_date'       => 'date_format:"Y-m-d"|after:start_date',
        ];
    }
}
