<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Reservation;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations()
    {
        return $this ->hasMany(Reservation::class);
    }

    public static function register($request)
    {
        $isChecked = User::where('email', $request->email)->first();
        if ($isChecked) {
            return false;
        } else {
            $hashed_password = Hash::make($request->password);
            $param = [
                "user_name" => $request->name,
                "email" => $request->email,
                "password" => $hashed_password,
            ];
            $user= User::create($param);
            return $user;
        }
    }

    public static function getUsers ($users_id)
    {
        $user = User::find($users_id);
        if ($user) {
            return $user;
        }else{
            return false;
        }
    }

    public static function loginUsers ($request)
    {
        $user = User::where ('email' ,$request -> email) ->first();
        $isChecked = Hash::check($request -> password, $user -> password);
        if($isChecked){
            return $user;
        }else{
            return false;
        }

    }
}