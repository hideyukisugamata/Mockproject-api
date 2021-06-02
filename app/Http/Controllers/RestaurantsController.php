<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Favorite;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function getRestaurants(Request $request)
    {
        $items = Restaurant::getRestaurants($request);
        return response()-> json([
            'message' => 'Restaurants information got successfully',
            'data' => $items
        ],200);
    }

    public function getRestaurant($restaurants_id, Request $request)
    {
        $item = Restaurant::getRestaurant($restaurants_id,$request);
        if($item){    
            return response() -> json([
                'message' => 'Restaurant information got successfully',
                'data' => $item,
        ],200);
        }else{
            return response() -> json([
                'message' => 'Restaurant not found',
                'data' => $item
            ],404);
        }
    }
}
