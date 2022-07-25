<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Role[] $roles
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'route_name'];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
