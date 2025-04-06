<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
class UserController extends Controller
{

    public function index()
    {
    try {
        return response()->json(User::all(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error fetching users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                $user = Auth::user();
                $token = $user->createToken('myToken')->plainTextToken;
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                ], 200);
            }
            return response()->json([
                'message' => 'Invalid Credentials',
            ], 401);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred during login',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email_address',
            'role' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
    
        $user = user::create($validatedData);
    
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function update(Request $request, $id)
{
    $user = user::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $validatedData = $request->validate([
        'name' => 'sometimes|string',
        'email' => 'sometimes|email|unique:employees,email_address,' . $id,
        'role' => 'sometimes|string',
    ]);

    $user->update($validatedData);

    return response()->json([
        'user' => $user,
    ], 200);
}

public function destroy($id)
{
    $user = user::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404); 
    }

    $user->delete();

    return response()->json([
        'message' => 'User deleted']);
}


public function hello(){
    return response()->json([
        'message'=>'Hello Word'
    ]);
}
  
}



