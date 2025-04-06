<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

abstract class Controller
{
    public function hello(){
        return response()->json([
            'message'=>'Hello Word'
        ]);
    }
}
