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
        $role = new Role();
        $role->name = "super-admin";
        if ($role->save())
            $role->allowTo('force-delete');

        $role = new Role();
        $role->name = "admin";
        if ($role->save())
            $role->allowTo('modify');

        $role = new Role();
        $role->name = "designer";
        if ($role->save())
            $role->allowTo('publish');

        $role = new Role();
        $role->name = "user";
        if ($role->save())
            $role->allowTo('access');
    }
}
