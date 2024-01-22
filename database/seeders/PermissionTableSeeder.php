<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'admin-any',
            'owner-any'
        ];
    
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $roles = [
            'admin',
            'owner',
            // Add more roles as needed
        ];

        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);

            // Assign permissions to roles
            if ($roleName == 'admin') {
                // Example: Assigning permissions to the 'admin' role
                $role->givePermissionTo('role-list');
                $role->givePermissionTo('role-create');
                $role->givePermissionTo('role-edit');
                $role->givePermissionTo('role-delete');
                $role->givePermissionTo('admin-any');
            } elseif ($roleName == 'owner') {
                // Example: Assigning permissions to the 'owner' role
                $role->givePermissionTo('owner-any');
            }

            // Add more conditions for other roles as needed
        }
    }
}
