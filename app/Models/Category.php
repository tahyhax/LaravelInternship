<?php

namespace App\Models;

use App\Events\ImagesEvent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * Class Category
 *
 * @package App\Models
 * @property MorphMany images
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Category[] $children
 * @property-read int|null $children_count
 * @property-read string $image_main
 * @property-read int|null $images_count
 * @property-read Image|null $imagesMain
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @mixin \Eloquent
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @see config/filesystems
     */
    const FILE_STORAGE_LINK = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'parent_id',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeRootLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('children');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
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
     * @param array $images files  from category request
     * @return array
     */
    public function loadImagesToStore(array $images): array
    {
        $imagesList = [];
        foreach ($images as $image) {
            $path = $image->store(self::FILE_STORAGE_LINK);
            $name = substr($path, strlen(self::FILE_STORAGE_LINK . '/'));
            $imagesList[] = new Image(['name' => $name, 'storage_link' =>  self::FILE_STORAGE_LINK ]);
        }

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
