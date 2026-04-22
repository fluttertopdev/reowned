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

                            // NEW CONDITIONS
                            ->where('is_featured', 1)
                            ->orderBy('featured_position', 'asc')
                            ->get();
            
            $categoriesAll = Category::with(['children' => function ($q) {
                                $q->where('status', 1)
                                  ->orderBy('name');
                            }])
                            ->where('parent_id', 0)
                            ->where('status', 1)
                            ->orderBy('featured_position', 'asc')
                            ->get();

            $view->with([
                'headerCategories' => $categories,
                'mainCategories'   => $categoriesAll->take(6),
                'otherCategories'  => $categoriesAll->slice(6)
            ]);
        });
    }
}