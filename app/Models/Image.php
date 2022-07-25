<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $name
 * @property string $storage_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $image
 * @property-read Model|\Eloquent $imageable
 * @property-read Product $product
 * @mixin \Eloquent
 * @property string $imageable_type
 * @property int $imageable_id
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'storage_link'
    ];

    /**
     * @return MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        return asset('storage/' . $this->storage_link . '/' . $this->name);
    }

}
