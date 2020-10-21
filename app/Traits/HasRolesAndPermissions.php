<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions
{

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->roles->contains('slug', 'admin');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

//    /**
//     * @return mixed
//     */
//    public function permissions()
//    {
//        return $this->belongsToMany(Permission::class, 'users_permissions');
//    }

    /**
     * Check if the user has Role
     *
     * @param array $roles
     * @return boolean
     */
    public function hasRole(array $roles)
    {
        return !!$this->roles->whereIn('slug', $roles)->count();
    }
}