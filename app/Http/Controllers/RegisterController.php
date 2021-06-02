<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function post (Request $request)
    {
        $user = User::register($request);
        if($user){
            return response()->json([
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        }else{
            return response()->json([
                'message' => 'this email is already used',
            ], 401);
        }
    }
}
