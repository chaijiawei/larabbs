<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeedPermissionAndRoleData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'manage_contents']);
        Permission::create(['name' => 'manage_users']);

        Role::create(['name' => 'founder'])
            ->givePermissionTo(['manage_contents', 'manage_users']);

        Role::create(['name' => 'maintainer'])
            ->givePermissionTo(['manage_contents']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::findByName('founder')->delete();
        Role::findByName('maintainer')->delete();

        Permission::findByName('manage_contents')->delete();
        Permission::findByName('manage_users')->delete();
    }
}
