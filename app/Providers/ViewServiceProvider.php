<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('website.layout.header', function ($view) {

            $categories = Category::with(['children' => function ($q) {
                            $q->where('status', 1)
                              ->orderBy('name');
                        }])
                        ->where('parent_id', 0)
                        ->where('status', 1)
                        ->orderBy('name')
                        ->get();

            $view->with([
                'headerCategories' => $categories,          // for top select dropdown
                'mainCategories'   => $categories->take(6), // first 6
                'otherCategories'  => $categories->slice(6) // remaining
            ]);
        });
    }
}