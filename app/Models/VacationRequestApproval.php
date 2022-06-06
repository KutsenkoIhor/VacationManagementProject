<?php

declare(strict_types = 1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $vacation_request_id
 * @property int $user_id
 * @property bool $is_approved
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property User $user
 * @property VacationRequest $vacation_request
 */

class VacationRequestApproval extends Model
{
    use HasFactory;

    protected $casts = [
        'is_approved' => 'bool'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function vacation_request(): BelongsTo
    {
        return $this->belongsTo(VacationRequest::class, 'vacation_request_id', 'id');
    }
}
