<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $body
 * @property int $views
 * @property int $user_id
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property string|null $publish_at
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->whereDate('publish_at', '<', date('Y-m-d H:i:s'));
        });
    }

    protected $fillable = [
        'title', 'body', 'user_id', 'slug',
    ];

    //TODO непонятно чегоне зочет работать
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:s',
        'updated_at' => 'datetime:d/m/Y H:s',
    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
