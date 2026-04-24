<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check = User::where('type', 'admin')->first();
        if (!$check) {
            $user = User::create([
                'name' => 'Admin', 
                'type' => 'admin', 
                'email' => 'admin@demo.com',
                'password' => Hash::make('12345678'),
                'role_id' => 1,
                'status' => 1,
            ]);

            $role = Role::where('name', 'admin')->where('guard_name', 'admin')->first();

            if (!$role) {
                // If the 'admin' role for the 'web' guard doesn't exist, create it
                $role = Role::create([
                    'name' => 'admin',
                    'guard_name' => 'admin',
                    'status' => 1,
                    'created_at' => now(),
                ]);
            }

            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        }
    }
}