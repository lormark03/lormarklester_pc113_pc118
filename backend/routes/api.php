<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Controller;




Route::get('/hello', [UserController::class, 'hello']);


Route::get('/employees', [EmployeeController::class, 'employee']);
Route::get('/students', [StudentController::class, 'student']);

Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/students', [StudentController::class, 'index']);

Route::post('/employees', [EmployeeController::class, 'store']);
Route::post('/students', [StudentController::class, 'store']);

Route::post('/employees/{id}', [EmployeeController::class, 'update']);
Route::post('/students/{id}', [StudentController::class, 'update']);

Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);

Route::get('/employees/search', [EmployeeController::class, 'search']); 
Route::get('/students/search', [StudentController::class, 'search']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

//image upload
Route::post('/register', [UserController::class, 'store']);


    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/users/{id}', [UserController::class, 'update']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);



//middleware
//users
Route::middleware(['auth:sanctum', 'role:user'])->group(function(){
    Route::get('/userdashboard', [UserDashboardController::class, 'index']);
});
//admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){
    Route::get('/user', [UserController::class, 'index']);
    
});

Route::post('upload-image', [UserController::class, 'uploadImage']);
