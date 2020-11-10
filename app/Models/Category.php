<?php

namespace App\Models;

use App\Events\ImagesEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Category
 * @package App\Models
 * @property MorphMany images
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
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
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
     * @param array $images files  from category request
     * @return array
     */
    public function loadImagesToStore($images)
    {
        $imagesList = [];
        foreach ($images as $image) {
            $path = $image->store(self::FILE_STORAGE_LINK);
            $name = substr($path, strlen(self::FILE_STORAGE_LINK . '/'));
            $imagesList[] = new Image(['name' => $name, 'storage_link' =>  self::FILE_STORAGE_LINK ]);
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
