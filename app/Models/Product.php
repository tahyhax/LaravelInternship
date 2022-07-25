<?php

namespace App\Models;

use App\Events\ImagesEvent;
use App\Http\Filters\QueryFilters;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $brand_id
 * @property-read Brand $brand
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read string $image_main
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read Image|null $imagesMain
 * @property-read Collection|Order[] $orders
 * @property-read int|null $orders_count
 * @method static Builder|Product filter(QueryFilters $filter)
 * @mixin \Eloquent
 * @property-read Collection|Product[] $similar
 * @property-read int|null $similar_count
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @return MorphOne
     */
    public function imagesMain(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')
            ->orderBy('id', 'DESC')
            ->latest();
    }

    /**
     * @return BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }

    /**
     * @return BelongsToMany
     */
    public function similar(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_similar',
            'product_id',
            'similar_id'
        );
    }

    /**
     * @param array $images files  from product request
     * @return array
     */
    public function loadImagesToStore(array $images): array
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

    //есть дублика этого функционала  надо вынести в  трейт
    /**
     * get main image fro scope  images
     * @return string
     */
    public function getImageMainAttribute(): string
    {
        return $this->imagesMain ? $this->imagesMain->image : 'http://placehold.it/700x400';
    }

}
