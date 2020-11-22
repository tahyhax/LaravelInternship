<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $name
 * @property string $storage_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $image
 * @property-read Model|\Eloquent $imageable
 * @property-read \App\Models\Product $product
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
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getImageAttribute()
    {
        return asset('storage/' . $this->storage_link . '/' . $this->name);
    }

}
