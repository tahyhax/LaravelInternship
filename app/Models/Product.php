<?php

namespace App\Models;

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
            $path = $image->store('products');
            $name = substr($path, strlen('products/'));
            $imagesList[] = new Image(['name' => $name, 'storage_link' => 'products']);
        }

        return isset($imagesList) ? $imagesList : [];

    }

}
