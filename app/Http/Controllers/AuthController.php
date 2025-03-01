<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'requred|email',
            'password' => 'required'
        ]);

        $user =  User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)){
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = Str::random(100);
         $user->update(['api_token' => $token]);

        return response()->json([
            'token' => $token,
            'user' => $user->only(['id','name','email'])
        ]);
    }

     
}
