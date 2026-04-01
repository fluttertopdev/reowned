<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

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

        $itemQuery = Item::where('slug',$slug)
            ->where('status',1)
            ->with([
                'images',
                'latestImage',
                'user',
                'customFields'
            ]);

        if($lat && $lng){

            $itemQuery->select('items.*')
                ->selectRaw("
                    (6371 * acos(
                        cos(radians(?)) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(?)) 
                        + sin(radians(?)) 
                        * sin(radians(latitude))
                    )) AS distance
                ", [$lat, $lng, $lat])

                ->having("distance", "<=", $radius);

        } else {

            // fallback
            if($city){
                $itemQuery->where('city', $city);
            }

            if($state){
                $itemQuery->where('state', $state);
            }
        }

        $item = $itemQuery->first();

        if(!$item){
            return redirect('/')
                ->with('error', 'Item not available in your area');
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
            $isFavorite = Favorite::where('user_id',$userId)
                ->where('item_id',$item->id)
                ->exists();
        }

        return view('website.item.item_detail',compact('item','relatedItems','isFavorite'));
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

