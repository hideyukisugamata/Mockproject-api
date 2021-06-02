<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function get($users_id)
    {
        $user = User::getUsers($users_id);
        if ($user) {
            return response()->json([
                'message' => 'User information got successfully',
                'data' => $user
            ],200);
        }else{
            return response() ->json([
                'status' => 'unauthorized',
                'data' => $user
            ],401);
        }
    }
}
