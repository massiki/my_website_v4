<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'key',
        'value',
        'image',
    ];

    /**
     * Get a home content value by key.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    /**
     * Get a home content image by key.
     */
    public static function getImage(string $key): ?string
    {
        return static::where('key', $key)->value('image');
    }

    /**
     * Set a home content value by key.
     */
    public static function setValue(string $key, ?string $value = null, ?string $image = null): static
    {
        return static::updateOrCreate(
            ['key' => $key],
            array_filter(['value' => $value, 'image' => $image], fn ($v) => $v !== null)
        );
    }
}
