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

    //NOTE тупо на но работает))

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'imageable_id');
    }

    /**
     * @return string
     */
    public function getImageAttribute()
    {
        return asset($this->storage_link . '/' . $this->name);
    }

}
