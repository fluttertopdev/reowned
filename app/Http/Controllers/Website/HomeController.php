<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        // Get location from session
        $lat     = session('user_lat');
        $lng     = session('user_lng');
        $radius  = session('radius', 20);

        $city    = session('city');
        $state   = session('state');
        $pincode = session('pincode');
        $area    = session('area');

        // Categories
        $data['homeCategories'] = Category::where('status',1)
            ->where('parent_id',0)
            ->orderBy('id','DESC')
            ->get();

        // Base Query (COMMON)
        $baseQuery = Item::where('items.status',1)
            ->where('user_id','!=',$userId)
            ->whereNull('items.deleted_at')
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function($q) use ($userId){
                $q->where('user_id',$userId)
                  ->whereNull('deleted_at');
            }]);

        // Apply Location Filter
        if($lat && $lng){

            $baseQuery->select('items.*')
                ->selectRaw("
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

        } else {

            // fallback (if lat/lng not available)
            if($city){
                $baseQuery->where('city', $city);
            }

            if($state){
                $baseQuery->where('state', $state);
            }

            if($pincode){
                $baseQuery->where('pincode', $pincode);
            }

            if($area){
                $baseQuery->where('area', 'like', '%'.$area.'%');
            }
        }

        // Recommended (Random Nearby)
        $data['recommendateItemData'] = (clone $baseQuery)
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Popular (Latest Nearby)
        $data['popularItemData'] = (clone $baseQuery)
            ->orderBy('id','DESC')
            ->limit(8)
            ->get();

        // All Items (Latest Nearby)
        $data['allItemData'] = (clone $baseQuery)
            ->orderBy('id','DESC')
            ->limit(8)
            ->get();

        // Total Count
        $data['totalItemCount'] = (clone $baseQuery)->count();

        return view('website.index', $data);
    }


    public function loadItems(Request $request)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        // Get location from session
        $lat     = session('user_lat');
        $lng     = session('user_lng');
        $radius  = session('radius', 20);

        $city    = session('city');
        $state   = session('state');
        $pincode = session('pincode');
        $area    = session('area');

        // Base Query
        $query = Item::where('items.status',1)
            ->where('user_id','!=',$userId)
            ->whereNull('items.deleted_at')
            ->with('latestImage');

        // Apply Location Filter
        if($lat && $lng){

            $query->select('items.*')
                ->selectRaw("
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

        } else {

            // fallback
            if($city){
                $query->where('city', $city);
            }

            if($state){
                $query->where('state', $state);
            }

            if($pincode){
                $query->where('pincode', $pincode);
            }

            if($area){
                $query->where('area', 'like', '%'.$area.'%');
            }
        }

        // Category Filter
        if($request->category_id){
            $query->where('category_id',$request->category_id);
        }

        // Sorting
        if($request->sort_by == 'low_to_high'){
            $query->orderBy('price','ASC');
        }
        elseif($request->sort_by == 'high_to_low'){
            $query->orderBy('price','DESC');
        }
        elseif($request->sort_by == 'oldest'){
            $query->orderBy('created_at','ASC');
        }
        else{
            //  IMPORTANT: if distance exists, don't override it
            if(!$lat){
                $query->orderBy('created_at','DESC');
            }
        }

        // Pagination (load more)
        $items = $query->skip($request->offset)
                       ->take(8)
                       ->get();

        return view('website.partial.item_card_list', compact('items'))->render();
    }


    public function saveLocation(Request $request)
    {
        session([
            'user_lat' => $request->lat,
            'user_lng' => $request->lng,
            'radius'   => $request->radius,
            'area'     => $request->area,
            'city'     => $request->city,
            'state'    => $request->state,
            'pincode'  => $request->pincode,
        ]);

        return response()->json(['status' => 'success']);
    }
   
}