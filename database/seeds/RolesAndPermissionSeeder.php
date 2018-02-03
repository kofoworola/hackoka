<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        // create roles and assign existing permissions
        $role = Role::create(['name' => 'admin']);

        $role = Role::create(['name' => 'doctor']);

		$role = Role::create(['name' => 'patient']);

    }
}
