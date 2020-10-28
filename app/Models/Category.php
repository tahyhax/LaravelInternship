<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
     * @param array $images files  from category request
     * @return array
     */
    public function loadImagesToStore($images)
    {
        foreach ($images as $image) {
            $path = $image->store('categories');
            $name = substr($path, strlen('categories/'));
            $imagesList[] = new Image(['name' => $name, 'storage_link' => 'categories']);
        }

        return isset($imagesList) ? $imagesList : [];

    }



}
