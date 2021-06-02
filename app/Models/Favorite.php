<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'restaurant_id',
    ];

    public function Restaurant()
    {
        return $this -> belongsTo(Restaurant::class);
    }

    public static function getFavorite($users_id)
    {
        $items = Favorite::where('user_id',$users_id) -> with('restaurant') -> get();
        return $items;
    }

    public static function putFavorite($users_id, Request $request)
    {
        $ischecked = Favorite::where('user_id',$users_id) -> where('restaurant_id',$request -> restaurant_id) -> first();
        if($ischecked){
            return false;
        }else{
            $params = [
                'user_id' => $users_id,
                'restaurant_id' => $request->restaurant_id,
            ];
            $createFavorite = Favorite::create($params);
            return $createFavorite;
        };
    }

    public static function deleteFavorite($users_id,Request $request)
    {
        $favorite = Favorite::where('user_id',$users_id) -> where('restaurant_id',$request -> restaurant_id) -> delete();
        return $favorite;
    }

    public static function isCheckedFavorite($restaurants_id,Request $request)
    {
        $isCheckedFavorite = Favorite::where('restaurant_id',$restaurants_id) -> where('user_id',$request -> users_id) -> first();
        if($isCheckedFavorite){
            return true;
        }else{
            return false;
        }
    }
}
