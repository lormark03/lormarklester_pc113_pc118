<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;

Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/students', [StudentController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::get('/employees/search', [EmployeeController::class, 'search']); 
Route::get('/students/search', [StudentController::class, 'search']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/login', [UserController::class, 'login']);




//middleware
Route::middleware(['auth:sanctum', 'role:user'])->group(function(){
    Route::get('/userdashboard', [UserDashboardController::class, 'index']);
});
Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){
    Route::get('/user', [UserController::class, 'index']);
});
