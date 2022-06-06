<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $table = 'allowed_domains';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
