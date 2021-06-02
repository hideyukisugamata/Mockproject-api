<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'time',
        'date',
        'num_users'
    ];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
    public function restaurant()
    {
        return $this -> belongsTo(Restaurant::class);
    }

    public static function getReservation($users_id)
    {
        $reservations = Reservation::where('user_id',$users_id) -> with('restaurant','user')-> get();
        return $reservations;
    }

    public static function postReservation($users_id,Request $request)
    {
        $params = [
            'user_id' => $users_id,
            'restaurant_id' => $request->restaurant_id,
            'date' => $request->date,
            'time' => $request->time,
            'num_users' => $request->num_users
        ];
        $reservation = Reservation::create($params);
        return $reservation;
    }

    public static function deleteReservation($users_id,Request $request)
    {
        $isChecked = Reservation::where ('user_id',$users_id) -> where ('id',$request -> id) -> delete();
        return $isChecked;
    }
}
