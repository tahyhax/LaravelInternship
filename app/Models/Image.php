<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'storage_link'
    ];

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
