<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'add reviwer']);
        Permission::create(['name' => 'delete reviwer']);
        Permission::create(['name' => 'publish reviwer']);
        Permission::create(['name' => 'unpublish reviwer']);

        // create roles and assign existing permissions
        $role = Role::where(['name' => 'author'])->first();
      
        $role->givePermissionTo('add reviwer');
        $role->givePermissionTo('delete reviwer');

        // create demo users
        $user = \App\Models\User::where('email', 'author@gmail.com')->first();
        // echo "<pre>";
        // print_r($user);exit;

        $user->assignRole($role);
    }
}