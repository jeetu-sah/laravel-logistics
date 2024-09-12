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
        Permission::updateOrCreate(['name' => 'add reviwer'], ['name' => 'add reviwer']);
        Permission::updateOrCreate(['name' => 'delete reviwer'], ['name' => 'delete reviwer']);
        Permission::updateOrCreate(['name' => 'publish reviwer'], ['name' => 'publish reviwer']);
        Permission::updateOrCreate(['name' => 'unpublish reviwer'], ['name' => 'unpublish reviwer']);

        // create roles and assign existing permissions
        $role = Role::where(['name' => 'admin'])->first();
      
        $role->givePermissionTo('add reviwer');
        $role->givePermissionTo('delete reviwer');

        // create demo users
        $user = \App\Models\User::where('email', 'admin@gmail.com')->first();
        // echo "<pre>";
        // print_r($user);exit;

        $user->assignRole($role);
    }
}