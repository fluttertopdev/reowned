<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class RoleHasPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cache (IMPORTANT)
        Artisan::call('permission:cache-reset');

        /**
         * ================================
         * CREATE ROLES
         * ================================
         */
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'admin'
        ]);

        $staffRole = Role::firstOrCreate([
            'name' => 'staff',
            'guard_name' => 'admin'
        ]);

        /**
         * ================================
         * ASSIGN ALL PERMISSIONS TO ADMIN
         * ================================
         */
        $allPermissions = Permission::where('guard_name', 'admin')->get();

        $adminRole->syncPermissions($allPermissions);

        /**
         * ================================
         * STAFF PERMISSIONS (LIMITED)
         * ================================
         */
        $staffPermissions = Permission::where('guard_name', 'admin')
            ->where(function ($q) {
                $q->where('name', 'like', '%.index')   // list
                  ->orWhere('name', 'like', '%.store') // add
                  ->orWhere('name', 'like', '%.update'); // update
            })
            ->get();

        $staffRole->syncPermissions($staffPermissions);

        /**
         * ================================
         * ASSIGN ROLE TO USERS
         * ================================
         */

        // Admin user
        $adminUser = User::where('type', 'admin')->first();
        if ($adminUser) {
            $adminUser->syncRoles([$adminRole]);
        }

        // All staff users
        $staffUsers = User::where('type', 'staff')->get();

        foreach ($staffUsers as $staff) {
            $staff->syncRoles([$staffRole]);
        }

        /**
         * ================================
         * OPTIONAL: RESET DIRECT PERMISSIONS
         * ================================
         */
        DB::table('model_has_permissions')->truncate();

        /**
         * ================================
         * DONE
         * ================================
         */
        $this->command->info('Roles & Permissions seeded successfully 🚀');
    }
}