<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'SuperAdmin',
                'slug' => 'super-admin',
                'description' => 'this is  man like ...'
            ],
            [
                'name' => 'customer',
                'slug' => 'customer ',
                'description' => 'the person who was registered on the site'
            ],
        ];

        Role::insert($roles);
    }
}
