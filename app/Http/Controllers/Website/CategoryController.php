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
        $radius  = $request->radius ?? session('radius', 20);

        $city    = session('city');
        $state   = session('state');

        $slug = $request->slug ?? $slug;

        // =========================
        // BASE QUERY (ALL FILTERS)
        // =========================
        $baseQuery = Item::where('status',1)
            ->where('user_id','!=',$userId)
            ->whereNull('deleted_at');

        // CATEGORY
        if($slug && $slug !== 'all'){
            $categoryData = Category::where('slug',$slug)->first();

            if($categoryData){
                if($categoryData->parent_id == 0){
                    $baseQuery->where('category_id',$categoryData->id);
                }else{
                    $baseQuery->where('subcategory_id',$categoryData->id);
                }
            }
        }

        // SEARCH
        if($search){
            $baseQuery->where('title','like','%'.$search.'%');
        }

        // CITY / STATE
        if($city){
            $baseQuery->where('city', $city);
        }

        if($state){
            $baseQuery->where('state', $state);
        }

        // New
        // =========================
        // GLOBAL QUERY (NO PRICE FILTER)
        // =========================
        $globalQuery = Item::where('status',1)
            ->where('user_id','!=',$userId)
            ->whereNull('deleted_at');

        // CATEGORY
        if($slug && $slug !== 'all'){
            $categoryData = Category::where('slug',$slug)->first();

            if($categoryData){
                if($categoryData->parent_id == 0){
                    $globalQuery->where('category_id',$categoryData->id);
                }else{
                    $globalQuery->where('subcategory_id',$categoryData->id);
                }
            }
        }

        // SEARCH
        if($search){
            $globalQuery->where('title','like','%'.$search.'%');
        }

        // CITY / STATE
        if($city){
            $globalQuery->where('city', $city);
        }

        if($state){
            $globalQuery->where('state', $state);
        }

        // DATE
        if($request->date_filter){
            if($request->date_filter == 'today'){
                $globalQuery->whereDate('created_at', now());
            }elseif($request->date_filter == 'week'){
                $globalQuery->where('created_at', '>=', now()->subDays(7));
            }elseif($request->date_filter == 'month'){
                $globalQuery->where('created_at', '>=', now()->subDays(30));
            }
        }

        // DISTANCE
        if($lat && $lng){
            $globalQuery->whereRaw("
                (6371 * acos(
                    cos(radians(?)) 
                    * cos(radians(latitude)) 
                    * cos(radians(longitude) - radians(?)) 
                    + sin(radians(?)) 
                    * sin(radians(latitude))
                )) <= ?
            ", [$lat, $lng, $lat, $radius]);
        }

        // PRICE
        if($request->has('min_price') && $request->has('max_price')){
            $baseQuery->whereBetween('price', [
                $request->min_price,
                $request->max_price
            ]);
        }

        // AREA (ONLY FOR ITEMS)
        if($request->area){
            $baseQuery->where('area', 'like', '%'.$request->area.'%');
        }

        // DATE
        if($request->date_filter){
            if($request->date_filter == 'today'){
                $baseQuery->whereDate('created_at', now());
            }elseif($request->date_filter == 'week'){
                $baseQuery->where('created_at', '>=', now()->subDays(7));
            }elseif($request->date_filter == 'month'){
                $baseQuery->where('created_at', '>=', now()->subDays(30));
            }
        }

        // =========================
        // ITEMS QUERY
        // =========================
        $items = (clone $baseQuery)
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function ($q) use ($userId) {
                $q->where('user_id', $userId)->whereNull('deleted_at');
            }]);

        // DISTANCE
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

            ->having("distance", "<=", $radius);
        }

        // SORT
        if($sort == 'low_to_high'){
            $items->orderBy('price','asc');
        }elseif($sort == 'high_to_low'){
            $items->orderBy('price','desc');
        }elseif($sort == 'oldest'){
            $items->oldest();
        }else{
            $items->latest();
        }

        $items = $items->paginate(12);

        // =========================
        // LOCATION QUERY (NO AREA FILTER)
        // =========================
        $locationQuery = Item::where('status',1)
            ->where('user_id','!=',$userId)
            ->whereNull('deleted_at');

        // APPLY SAME FILTERS EXCEPT AREA

        if($slug && $slug !== 'all'){
            if(isset($categoryData)){
                if($categoryData->parent_id == 0){
                    $locationQuery->where('category_id',$categoryData->id);
                }else{
                    $locationQuery->where('subcategory_id',$categoryData->id);
                }
            }
        }

        if($search){
            $locationQuery->where('title','like','%'.$search.'%');
        }

        if($city){
            $locationQuery->where('city', $city);
        }

        if($state){
            $locationQuery->where('state', $state);
        }

        if($request->has('min_price') && $request->has('max_price')){
            $locationQuery->whereBetween('price', [
                $request->min_price,
                $request->max_price
            ]);
        }

        if($request->date_filter){
            if($request->date_filter == 'today'){
                $locationQuery->whereDate('created_at', now());
            }elseif($request->date_filter == 'week'){
                $locationQuery->where('created_at', '>=', now()->subDays(7));
            }elseif($request->date_filter == 'month'){
                $locationQuery->where('created_at', '>=', now()->subDays(30));
            }
        }

        // DISTANCE FIX (NO HAVING)
        if($lat && $lng){
            $locationQuery->whereRaw("
                (6371 * acos(
                    cos(radians(?)) 
                    * cos(radians(latitude)) 
                    * cos(radians(longitude) - radians(?)) 
                    + sin(radians(?)) 
                    * sin(radians(latitude))
                )) <= ?
            ", [$lat, $lng, $lat, $radius]);
        }

        $locationData = $locationQuery
            ->selectRaw('area, city, state, country, COUNT(*) as total')
            ->groupBy('area','city','state','country')
            ->orderBy('total','DESC')
            ->get();

        $locations = [];

        foreach ($locationData as $loc) {

            // hide 0 count (safety)
            if($loc->total == 0) continue;

            $locations[$loc->country][$loc->state][$loc->city][] = [
                'area'  => $loc->area,
                'count' => $loc->total
            ];
        }

        // =========================
        // MAX PRICE
        // =========================
        $maxPriceValue = (clone $globalQuery)->max('price') ?? 50000;
        $maxPriceValue = ceil($maxPriceValue / 100) * 100;

        // =========================
        // CATEGORY COUNTS (FILTERED)
        // =========================
        $itemCounts = (clone $baseQuery)
            ->selectRaw('subcategory_id, COUNT(*) as total')
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

        // =========================
        // AJAX
        // =========================
        if($request->ajax()){

            $itemsHtml = view('website.partial.item_card_list_account', compact('items'))->render();

            $filtersHtml = view('website.category.detail', [
                'category' => $category,
                'locations' => $locations,
                'maxPriceValue' => $maxPriceValue,
                'slug' => $slug,
                'items' => $items,

                // IMPORTANT (ADD THESE)
                'selectedCategory' => $slug,
                'selectedArea' => $request->area,
                'selectedDate' => $request->date_filter,
                'minPrice' => $request->min_price ?? 0,
                'maxPrice' => $request->max_price ?? $maxPriceValue,
                'radiusValue' => $request->radius ?? 20
            ])->render();

            return response()->json([
                'items' => $itemsHtml,
                'filters' => $filtersHtml
            ]);
        }

        return view('website.category.detail',compact(
            'items',
            'slug',
            'category',
            'locations',
            'maxPriceValue'
        ))->with([
            'selectedCategory' => $slug,
            'selectedArea' => $request->area,
            'selectedDate' => $request->date_filter,
            'minPrice' => $request->min_price ?? 0,
            'maxPrice' => $request->max_price ?? $maxPriceValue,
            'radiusValue' => $request->radius ?? 20
        ]);
    }
   
}

