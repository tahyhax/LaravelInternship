<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions
{

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->roles()->where('slug', 'admin')->exists();
    }

    /**
     * @param string $route
     * @return mixed
     */
    public function hasRouteAccess(string $route)
    {
        return $this->roles()->whereHas('permissions',
            function ($query) use ($route) {
                $query->where('route_name', $route);
            }
        )->exists();
    }

    /**
     * Check if the user has Role
     *
     * @param array $roles
     * @return boolean
     */
    public function hasRole(array $roles)
    {
        return $this->roles()->whereIn('slug', $roles)->exists();
    }
}