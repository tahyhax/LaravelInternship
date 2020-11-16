<?php

namespace App\Models;

use App\Events\ImagesEvent;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $sku
 * @property string|null $description
 * @property float $price
 * @property int $in_stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $brand_id
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read string $image_main
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Image|null $imagesMain
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product filter(\App\Http\Filters\QueryFilters $filter)
 * @mixin \Eloquent
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
    public function loadImagesToStore(array $images)
    {
        $imagesList = [];
        foreach ($images as $image) {
            $path = $image->store(self::FILE_STORAGE_LINK);
            $name = substr($path, strlen(self::FILE_STORAGE_LINK . '/'));
            $imagesList[] = new Image(['name' => $name, 'storage_link' => self::FILE_STORAGE_LINK]);
        }

        //TODO  как правильно ето сделать ?
        event(new ImagesEvent($this->images));

        return $imagesList;

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
