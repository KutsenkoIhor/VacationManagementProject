<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $vacation_id
 * @property int $user_id
 * @property string $status
 * @property $user
 * @property $vacation
 */

class VacationApproval extends Model
{
    use HasFactory;

    public const STATUS_APPROVED = 'APPROVED';
    public const STATUS_DENIED = 'DENIED';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function vacation(): BelongsTo
    {
        return $this->belongsTo(Vacation::class, 'vacation_id', 'id');
    }
}
