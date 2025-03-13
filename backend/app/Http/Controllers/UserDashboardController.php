<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Welcome to the dashboard',
            'user' => Auth::user(),
        ]);
    }
}
