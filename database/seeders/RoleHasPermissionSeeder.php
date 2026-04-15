<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class RoleHasPermissionSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * CREATE ROLES
         */
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'admin'
        ]);

        /**
         * ADMIN ROLE PERMISSIONS
         */
        $adminPermissions = Permission::where('guard_name', 'admin')
            ->pluck('id')
            ->toArray();

        $adminRole->permissions()->sync($adminPermissions);

        /**
         * ASSIGN ROLE TO USER
         */
        $adminUser = User::where('type', 'admin')->first();
        if ($adminUser) {
            $adminUser->role_id = $adminRole->id;
            $adminUser->save();
        }
    }
}