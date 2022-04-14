<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $casts = [
        'metadata' => 'array',
        'collection' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
