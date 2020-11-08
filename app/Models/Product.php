<?php

namespace App\Models;

use App\Events\ImagesEvent;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory, Filterable;

    /**
     * @see config/filesystems
     */
    const FILE_STORAGE_LINK = 'products';

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'price',
        'description',
        'price',
    ];

    protected $casts = [

        'price' => 'float'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function imagesMain()
    {
        return $this->morphOne(Image::class, 'imageable')
            ->orderBy('id', 'DESC')
            ->latest();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }

    /**
     * @param array $images files  from product request
     * @return array
     */
    public function loadImagesToStore($images)
    {
        foreach ($images as $image) {
            $path = $image->store(self::FILE_STORAGE_LINK);
            $name = substr($path, strlen(self::FILE_STORAGE_LINK . '/'));
            $imagesList[] = new Image(['name' => $name, 'storage_link' => self::FILE_STORAGE_LINK ]);
        }

        //TODO  как правильно ето сделать ?
        event(new ImagesEvent($this->images));

        return isset($imagesList) ? $imagesList : [];

    }

    /**
     * get main image fro scope  images
     * @return string
     */
    public function getImageMainAttribute(): string
    {
        return $this->imagesMain ? $this->imagesMain->image : 'http://placehold.it/700x400';
    }

}
