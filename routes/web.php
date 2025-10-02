<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

//home page
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

//authentication
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 
//login เสร็จไปหน้า Dashboard
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

//product home page
Route::get('/detail/{id}', [HomeController::class, 'detail']);
Route::get('/search',  [HomeController::class, 'searchProduct']);

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

//User crud
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/adding',  [UserController::class, 'adding']);
Route::post('/user',  [UserController::class, 'create']);
Route::get('/user/{id}',  [UserController::class, 'edit']);
Route::put('/user/{id}',  [UserController::class, 'update']);
Route::delete('/user/remove/{id}',  [UserController::class, 'remove']);
Route::get('/user/reset/{id}',  [UserController::class, 'reset']);
Route::put('/user/reset/{id}',  [UserController::class, 'resetPassword']);

//Food crud
Route::get('/food', [FoodController::class, 'index']);
Route::get('/foodlist', [FoodController::class, 'indexlist']);
Route::get('/food/adding',  [FoodController::class, 'adding']);
Route::post('/food',  [FoodController::class, 'create']);
Route::get('/food/{id}',  [FoodController::class, 'edit']);
Route::put('/food/{id}',  [FoodController::class, 'update']);
Route::delete('/food/remove/{id}',  [FoodController::class, 'remove']);

//Pet crud
Route::get('/pet', [PetController::class, 'index']);
Route::get('/petlist', [PetController::class, 'indexlist']);
Route::get('/pet/adding',  [PetController::class, 'adding']);
Route::post('/pet',  [PetController::class, 'create']);
Route::get('/pet/{id}',  [PetController::class, 'edit']);
Route::put('/pet/{id}',  [PetController::class, 'update']);
Route::delete('/pet/remove/{id}',  [PetController::class, 'remove']);

//link to order page
Route::get('/dog', [PetController::class, 'dogs'])->name('dog');
Route::get('/cat', [PetController::class, 'cats'])->name('cat');
Route::get('/raccoon', [PetController::class, 'raccoons'])->name('raccoon');
Route::get('/menu', [FoodController::class, 'indexlist'])->name('menu');