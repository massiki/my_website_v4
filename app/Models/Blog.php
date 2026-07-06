<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'status' => 'string',
        ];
    }

    public function blogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function author(): BelongsTo
    {
        return $this->user();
    }

    public function category(): BelongsTo
    {
        return $this->blogCategory();
    }
}
