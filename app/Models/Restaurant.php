<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;

class Restaurant extends Model
{
    use HasFactory;

    public function area()
    {
        return $this -> belongsTo(Area::class,);
    }

    public function genre()
    {
        return $this -> belongsTo(Genre::class);
    }

    public function favorites()
    {
        return $this -> hasMany(Favorite::class);
    }
    public function reservations()
    {
        return $this -> hasMany(Reservation::class);
    }

    public static function getRestaurants($request)
    {
        $items = Restaurant::with('area','genre') -> with('reservations',function($query)use($request){
            $query -> where('user_id',$request -> users_id);
        })->with('favorites',function($query)use($request){
            $query -> where ('user_id',$request -> users_id);
        })-> get();
        return $items;
    }

    public static function getRestaurant($restaurants_id,$request)
    {
        $item = Restaurant::where('id',$restaurants_id) -> with('area','genre')-> with('favorites',function($query)use($request){
            $query -> where ('user_id',$request -> users_id);
        })-> first();
        return $item;
    }
}
