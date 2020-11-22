<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $routesList = \Route::getRoutes()->getRoutesByName();

        foreach ($routesList as $key => $route) {
            if (preg_match('#^(debugbar|livewire).*\z#u', $key) === 1) {
                continue;
            }
            $nameStudly = Str::studly(str_replace(['.'], '-', $key));
            $data[] = [
                'name' => $nameStudly,
                'slug' => Str::slug($nameStudly),
                'route_name' => $key
            ];
        }

        Permission::insert($data);
    }

}
