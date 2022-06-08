<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $country_id
 * @property string|null $title
 */

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'country_id'
    ];


    /**
     * @return BelongsTo
     */
    public function countries(): BelongsTo

    {
        return $this->belongsTo(Country::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
