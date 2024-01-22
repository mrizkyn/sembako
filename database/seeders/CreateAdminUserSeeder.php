<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'riskita', 
            'email' => 'riskita@gmail.com',
            'password' => bcrypt('123123')
        ]);

        // Check if 'admin' role exists
        $role = Role::where('name', 'admin')->first();

        // If 'admin' role doesn't exist, create it
        if (!$role) {
            $role = Role::create(['name' => 'admin']);
            // Sync permissions if the role is newly created
            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
        }

        // Assign the 'admin' role to the user
        $user->assignRole([$role->id]);
    }
}
