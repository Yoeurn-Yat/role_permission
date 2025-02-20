<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = ['view', 'create', 'edit', 'delete'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions($permissions);

        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $user->syncPermissions(['view', 'create', 'edit']);

        $guest = Role::firstOrCreate(['name' => 'guest', 'guard_name' => 'web']);
        $guest->syncPermissions(['view']);
    }
}
