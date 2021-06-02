<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($users_id)
    {
        $items = Favorite::where('user_id', $users_id)->with('restaurant')->get();
        if ($items -> isNotEmpty()) {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request     $reserved = Reservation::where('user_id',$users_id) ->get();
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$users_id)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show($users_id,$favorite)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update($users_id,$favorite)
    {
        // return response()->json([
        //     'message' => 'test',
        //     'data' => $users_id,
        //     'data1'=> $favorite

        // ],200);

        $isChecked = Favorite::where('user_id',$users_id)->where('restaurant_id',$favorite) ->first();
        if($isChecked){
            return response()-> json([
                'message' => 'favorite already created',
                'data' => $isChecked
            ],200);
        }else{
            $param = [
                'user_id' => $users_id,
                'restaurant_id' => $favorite,
            ];
            Favorite::create($param);
            return response()->json([
                'message' => 'Favorite create successfully',
                'data' => $param
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy($users_id,$restaurants_id)
    {
        $item = Favorite::where('user_id',$users_id) -> where('restaurant_id',$restaurants_id) -> delete();
        if($item){
            return response()-> json([
                'message' => 'Favorite deleted successfully'
            ],200);
        }else{
            return response()-> json([
                'message' => 'Favorite not found'
            ],404);
        }
    }
}
