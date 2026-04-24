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

        /**
         * ================================
         * ASSIGN ALL PERMISSIONS TO ADMIN
         * ================================
         */
        $allPermissions = Permission::where('guard_name', 'admin')->get();

        $adminRole->syncPermissions($allPermissions);

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