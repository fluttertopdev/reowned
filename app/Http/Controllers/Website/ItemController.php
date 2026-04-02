<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{

    public function list(Request $request)
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
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function($q) use ($userId){
                $q->where('user_id',$userId)
                  ->whereNull('deleted_at');
            }]);

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

            $query->orderBy('id','DESC');
        }

        // Get Data
        $data['allItemData'] = $query->get();

        return view('website.item.item_list', $data);
    }

    public function detail($slug)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        $lat     = session('user_lat');
        $lng     = session('user_lng');
        $radius  = session('radius', 20);

        $city    = session('city');
        $state   = session('state');
        $pincode = session('pincode');
        $area    = session('area');

        $item = Item::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'images',
                'latestImage',
                'user',
                'customFields'
            ])
            ->first();

        if(!$item){
            return redirect('/')
                ->with('error', 'Item not found');
        }

        $isOwner = $userId == $item->user_id;

        if(!$isOwner){

            // LOCATION CHECK
            if($lat && $lng && $item->latitude && $item->longitude){

                $distance = $this->calculateDistance($lat, $lng, $item->latitude, $item->longitude);

                if($distance > $radius){
                    return redirect('/')
                        ->with('error', 'Item not available in your area');
                }

            } else {

                if($city && $item->city != $city){
                    return redirect('/')->with('error', 'Item not available in your area');
                }

                if($state && $item->state != $state){
                    return redirect('/')->with('error', 'Item not available in your area');
                }
            }

            // VIEW COUNT
            $key = 'viewed_item_'.$item->id.'_'.request()->ip();

            if(!Cache::has($key)){
                Item::where('id', $item->id)->increment('views');
                Cache::put($key, true, now()->addMinutes(1));
            }
        }

        $relatedQuery = Item::where('category_id',$item->category_id)
            ->where('id','!=',$item->id)
            ->where('status',1)
            ->where('user_id','!=',$userId)
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function($q) use ($userId){
                $q->where('user_id',$userId)
                  ->whereNull('deleted_at');
            }]);

        if($lat && $lng){

            $relatedQuery->select('items.*')
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

            if($city){
                $relatedQuery->where('city', $city);
            }
        }

        $relatedItems = $relatedQuery->limit(8)->get();


        $isFavorite = false;

        if(Auth::guard('web')->check()){
            $isFavorite = Auth::check() 
                ? Favorite::where('user_id',$userId)
                    ->where('item_id',$item->id)
                    ->whereNull('deleted_at')
                    ->exists()
                : false;
        }

        return view('website.item.item_detail',compact('item','relatedItems','isFavorite'));
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        return 6371 * acos(
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            cos(deg2rad($lng2 - $lng1)) +
            sin(deg2rad($lat1)) *
            sin(deg2rad($lat2))
        );
    }


    public function toggleFavorite(Request $request)
    {
        $itemId = $request->item_id;
        $userId = auth()->id();

        $favorite = Favorite::where('user_id',$userId)
                    ->where('item_id',$itemId)
                    ->first();

        if($favorite){
            $favorite->delete();

            return response()->json([
                'status' => 'removed'
            ]);
        }else{

            Favorite::create([
                'user_id'=>$userId,
                'item_id'=>$itemId
            ]);

            return response()->json([
                'status' => 'added'
            ]);
        }
    }
   
}

