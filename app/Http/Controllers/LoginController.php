<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $isChecked = User::loginUsers($request);
        if($isChecked) {
            return response() -> json([
                'auth' => true,
                'data' => $isChecked
            ],200);
        }else{
            return response() -> json([
                'auth' => false,
            ],401);
        }
    }
}
