<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        $items = Item::select('items.*')
            ->join('favourites','favourites.item_id','=','items.id')
            ->where('favourites.user_id',$userId)
            ->where('items.status',1)
            ->whereNull('items.deleted_at')
            ->whereNull('favourites.deleted_at')
            ->with(['latestImage'])
            ->latest()
            ->get();

        // mark all as favorite
        $items->each(function($item){
            $item->is_favorite = true;
        });

        return view('website.favorite.index',[
            'favoriteItems' => $items
        ]);
    }
   
}

