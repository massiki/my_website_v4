<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'technologies',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
        ];
    }
}
