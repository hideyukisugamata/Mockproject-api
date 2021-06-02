<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class Favoritesv2Controller extends Controller
{
    public function get($users_id)
    {
        $items = Favorite::getFavorite($users_id);
        if ($items->isNotEmpty()) {
            return response()->json([
                'message' => 'Favorite got successfully',
                'data' => $items,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nothing Favorite',
                'data' => $items
            ], 200);
        }
    }

    public function put ($users_id,Request $request)
    {
        $favorite = Favorite::putFavorite($users_id,$request);
        if ($favorite) {
            return response()->json([
                'message' => 'Favorite created successfully',
                'data' => $favorite
            ], 200);
        } else {
            return response()->json([
                'message' => 'favorite already created'
            ], 200);
        }
    }

    public function delete($users_id,Request $request)
    {
        $favorite = Favorite::deleteFavorite($users_id,$request);
        if ($favorite) {
            return response()->json([
                'message' => 'Favorite deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Favorite not found'
            ], 404);
        }
    }
}
