<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // If user not logged in → allow (or you can redirect)
        if (!Auth::check()) {
            return $next($request);
        }

        // Super Admin bypass (adjust role_id if needed)
        if (Auth::user()->role_id == 1) {
            return $next($request);
        }

        $permission = $this->getPermissionFromRequest($request);
        if (Auth::check() && $permission && !Auth::user()->can($permission)) {
            abort(403);
        }

        return $next($request);
    }

    private function normalize($action)
    {
        return match ($action) {
            'updatestatus' => 'updateStatus',
            default => $action,
        };
    }

    
    private function getPermissionFromRequest($request)
    {
        $routeName = $request->route()->getName();

        if (!$routeName) return null;

        $parts = explode('.', $routeName);

        if (count($parts) < 2) return $routeName;

        $module = $parts[0];
        $action = strtolower($parts[1]);

        // SPECIAL CASE FOR FORM
        if ($action === 'form') {

            if ($request->route('id')) {
                return auth('admin')->user()->can($module . '.update')
                    ? $module . '.update'
                    : $module . '.index';
            }

            return auth('admin')->user()->can($module . '.store')
                ? $module . '.store'
                : $module . '.index';
        }

        $groups = [
            'add' => ['create', 'store'],
            'update' => ['edit', 'update'],
            'index' => ['index'],
            'delete' => ['destroy'],
            'status' => ['updatestatus'],
            'translation' => ['translation', 'updatetranslate'],

            // FINAL FIX
            'assignpackage' => [
                'assignpackage',
                'assignitempackage',
                'adspackage',
                'itempackage'
            ],

            'userpackage' => ['userpackage'],
        ];

        foreach ($groups as $actions) {

            if (in_array($action, $actions)) {

                foreach ($actions as $possibleAction) {

                    $permission = $module . '.' . $this->normalize($possibleAction);

                    if (auth('admin')->user()->can($permission)) {
                        return $permission;
                    }
                }

                return $module . '.' . $this->normalize($actions[0]);
            }
        }

        return $routeName;
    }
}
