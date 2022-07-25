<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRolesAndPermissions
{

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->roles()->where('slug', User::ADMIN_SLUG)->exists();
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isSuperAdmin(): bool
    {
        return $this->roles()->where('slug', User::SUPER_ADMIN_SLUG)->exists();
    }

    /**
     * @param string $route
     * @return bool
     */
    public function hasRouteAccess(string $route): bool
    {
        return $this->isSuperAdmin() || $this->roles()->whereHas('permissions',
            fn($query) => $query->where('route_name', $route)
        )->exists();
    }

    /**
     * Check if the user has Role
     *
     * @param array $roles
     * @return boolean
     */
    public function hasRole(array $roles): bool
    {
        return $this->roles()->whereIn('slug', $roles)->exists();
    }
}
