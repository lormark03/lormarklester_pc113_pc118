<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;

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
    try{
        
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|string',
        'password' => 'required|string|min:8',
        'photo' => 'nullable|image|mimes:jpg,png,svg,jpeg|max:2048', // max 2MB
    ]);



    $imgPath = null;
    if ($request->hasFile('photo')) {
        $imgPath = $request->file('photo')->store('photos', 'public');
    }
    

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'photo' => $imgPath,
    ]);

    $user->photo = $user->photo ? asset('storage/' . $user->photo) : null;

    return response()->json([
        'message' => 'User created successfully',
        'user' => $user,
    ], 201);
    }catch(\Exception $e){
        return response()->json([
            'message' => "Error",
            'error' => $e->getMessage()
        ]);
    }
}

public function update(Request $request, $id)
{
    try {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'role' => 'sometimes|string',
            'photo' => 'sometimes|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user->update($validatedData);

        $user->photo = $user->photo ? asset('storage/' . $user->photo) : null;

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error updating user',
            'error' => $e->getMessage(),
        ], 500);
    }
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
  
 
public function uploadImage(Request $request)
{
    $v = $request->validate([
        'photo' => 'required|image|max:2048', // max 2MB
    ]);

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('uploads', 'public');
        
        $v['photo'] = $path;
    }

    User::create($v);

    return response()->json([
        'message' => 'Photo uploaded successfully',
        'image' => $v,
    ]);

    return response()->json(['message' => 'No Photo uploaded'], 400);
}

}



