<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Genre extends Model
{
    use HasFactory;

    public function Restaurants()
    {
        return $this -> hasMany(Restaurant::class);
    }
}
