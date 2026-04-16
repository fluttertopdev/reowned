<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;

class GeneratePermissions extends Command
{
    protected $signature = 'permissions:generate';
    protected $description = 'Generate permissions from routes';


    public function handle()
    {
        $routes = Route::getRoutes();

        // Dashboard default
        if (!Permission::where('name', 'dashboard.index')->exists()) {
            Permission::create([
                'module' => 'Dashboard',
                'name' => 'dashboard.index',
                'permission_name' => 'Dashboard',
                'group' => 'dashboard',
                'is_default' => 1,
                'guard_name' => 'admin',
            ]);

            $this->info("Created: dashboard.index (Default)");
        }

        $excludeKeywords = [
            'login', 'logout', 'profile', 'dashboard',
            'export', 'updatetranslate', 'setlanguage'
        ];

        // IMPORTANT: form removed completely
        $skipActions = ['form'];

        $map = [
            'index' => 'index',
            'store' => 'store',
            'update' => 'update',
            'destroy' => 'destroy',
            'updatestatus' => 'updateStatus',
            'translation' => 'translation',
            'assignpackage' => 'assignpackage',
            'userpackage' => 'userpackage',
            'reply' => 'reply',
        ];

        $created = [];

        $count = 0;

        foreach ($routes as $route) {

            $name = $route->getName();
            $middleware = $route->gatherMiddleware();

            if (!$name || !in_array('permission', $middleware)) {
                continue;
            }

            // Skip unwanted keywords
            foreach ($excludeKeywords as $keyword) {
                if (str_contains(strtolower($name), strtolower($keyword))) {
                    continue 2;
                }
            }

            $parts = explode('.', $name);

            if (count($parts) < 2) {
                continue;
            }

            $module = strtolower($parts[0]);
            $action = strtolower($parts[1]);

            // Skip form
            if (in_array($action, $skipActions)) {
                continue;
            }

            // Only mapped actions
            if (!isset($map[$action])) {
                continue;
            }

            $finalPermission = $module . '.' . $map[$action];

            // Prevent duplicate per module-action
            if (in_array($finalPermission, $created)) {
                continue;
            }

            // DB duplicate check
            if (Permission::where('name', $finalPermission)->exists()) {
                continue;
            }

            $permissionName = match ($action) {
                'index' => 'List',
                'store' => 'Add',
                'update' => 'Update',
                'destroy' => 'Delete',
                'updatestatus' => 'Status',
                'translation' => 'Translation',
                'assignpackage' => 'Assign Package',
                'userpackage' => 'User Package',
                'reply' => 'Reply',
                default => ucfirst($action),
            };

            Permission::create([
                'module' => ucfirst($module),
                'name' => $finalPermission,
                'permission_name' => $permissionName,
                'group' => $module,
                'is_default' => 0,
                'guard_name' => 'admin',
            ]);

            $created[] = $finalPermission;

            $this->info("Created: {$finalPermission}");
            $count++;
        }

        $this->info("Total Created: {$count}");
    }

}