<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A visitor's star rating plus a short written review.
 *
 * @property int $id
 * @property string $device_key
 * @property int $stars
 * @property string|null $author
 * @property string $body
 * @property bool $is_visible
 */
class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    protected $fillable = [
        'device_key',
        'stars',
        'author',
        'body',
        'is_visible',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'stars' => 'integer',
            'is_visible' => 'boolean',
        ];
    }

    /**
     * Only approved reviews are shown on the public page.
     *
     * @param  Builder<Rating>  $query
     */
    public function scopeVisible(Builder $query): void
    {
        $query->where('is_visible', true);
    }
}
