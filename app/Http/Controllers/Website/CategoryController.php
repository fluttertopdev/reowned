<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function detail($slug = null, Request $request)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        $search = $request->search;
        $sort   = $request->sort;

        $lat     = session('user_lat');
        $lng     = session('user_lng');
        $radius = $request->radius ?? session('radius', 20);

        $city    = session('city');
        $state   = session('state');
        $pincode = session('pincode');
        $area    = session('area');

        $itemCounts = Item::selectRaw('subcategory_id, COUNT(*) as total')
            ->where('status',1)
            ->where('user_id','!=',$userId)
            ->whereNull('deleted_at')
            ->groupBy('subcategory_id')
            ->pluck('total','subcategory_id');

        $category = Category::where('status',1)
            ->where('parent_id',0)
            ->with('children')
            ->get();

        foreach ($category as $cat) {

            $catTotal = 0;

            foreach ($cat->children as $sub) {

                $subCount = $itemCounts[$sub->id] ?? 0;

                $sub->items_count = $subCount;

                $catTotal += $subCount;
            }

            $cat->items_count = $catTotal;
        }

        $items = Item::where('items.status',1)
            ->where('user_id','!=',$userId)
            ->whereNull('items.deleted_at')
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->whereNull('deleted_at');
            }]);

        if($lat && $lng){

            $items->selectRaw("
                (6371 * acos(
                    cos(radians(?)) 
                    * cos(radians(latitude)) 
                    * cos(radians(longitude) - radians(?)) 
                    + sin(radians(?)) 
                    * sin(radians(latitude))
                )) AS distance
            ", [$lat, $lng, $lat])

            ->having("distance", "<=", $radius)
            ->orderBy("distance", "asc");
        }

        // category filter
        $slug = $request->slug ?? $slug;

        if($slug && $slug !== 'all'){

            $categoryData = Category::where('slug',$slug)->first();

            if($categoryData){

                // parent category
                if($categoryData->parent_id == 0){

                    $items->where('category_id',$categoryData->id);

                }else{

                    // subcategory
                    $items->where('subcategory_id',$categoryData->id);

                }

            }

        }

        // search filter
        if($search){
            $items->where('title','like','%'.$search.'%');
        }

        if($city){
            $items->where('city', $city);
        }

        if($state){
            $items->where('state', $state);
        }

        // sorting
        if($sort == 'low_to_high'){
            $items->orderBy('price','asc');
        }
        elseif($sort == 'high_to_low'){
            $items->orderBy('price','desc');
        }
        elseif($sort == 'oldest'){
            $items->oldest();
        }
        else{
            $items->latest();
        }


        if($request->has('min_price') && $request->has('max_price')){
            $items->whereBetween('price', [
                $request->min_price,
                $request->max_price
            ]);
        }

        if($request->area){
            $items->where('area', 'like', '%'.$request->area.'%');
        }

        if($request->date_filter){

            if($request->date_filter == 'today'){
                $items->whereDate('created_at', now());
            }

            elseif($request->date_filter == 'week'){
                $items->where('created_at', '>=', now()->subDays(7));
            }

            elseif($request->date_filter == 'month'){
                $items->where('created_at', '>=', now()->subDays(30));
            }

            // IMPORTANT
            elseif($request->date_filter == 'alltime'){
                // no filter
            }
        }

        $items = $items->paginate(12);


        // New
        $locationData = Item::selectRaw('area, city, state, country, COUNT(*) as total')
            ->where('status',1)
            ->whereNull('deleted_at')
            ->where('city', $city)
            ->groupBy('area','city','state','country')
            ->orderBy('total','DESC')
            ->get();

        $locations = [];

        foreach ($locationData as $loc) {

            $locations[$loc->country][$loc->state][$loc->city][] = [
                'area' => $loc->area,
                'count' => $loc->total
            ];
        }

        // Buget
        $priceRanges = Item::selectRaw("
            CASE
                WHEN price <= 5000 THEN '0-5000'
                WHEN price BETWEEN 5001 AND 10000 THEN '5001-10000'
                WHEN price BETWEEN 10001 AND 20000 THEN '10001-20000'
                ELSE '20000+'
            END as range_label,
            COUNT(*) as total
        ")
        ->where('status',1)
        ->whereNull('deleted_at')
        ->where('city', $city)
        ->groupBy('range_label')
        ->get();

        $maxPriceValue = Item::where('status',1)
            ->whereNull('deleted_at')
            ->max('price') ?? 50000;

        // AJAX request
        if($request->ajax()){
            return view('website.partial.item_card_list_account',compact('items'))->render();
        }

        return view('website.category.detail',compact('items','slug','category','locations','priceRanges','maxPriceValue'));
    }
   
}

