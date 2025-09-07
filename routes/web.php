<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\HomeController;

//home page
Route::get('/', [TestController::class, 'index']);
/*
//product home page
Route::get('/detail/{id}', [HomeController::class, 'detail']);
Route::get('/search',  [HomeController::class, 'searchProduct']);
*/

//Customer crud
Route::get('/customer', [CustomerController::class, 'index']);
Route::get('/customer/adding',  [CustomerController::class, 'adding']);
Route::post('/customer',  [CustomerController::class, 'create']);
Route::get('/customer/{id}',  [CustomerController::class, 'edit']);
Route::put('/customer/{id}',  [CustomerController::class, 'update']);
Route::delete('/customer/remove/{id}',  [CustomerController::class, 'remove']);
Route::get('/customer/reset/{id}',  [CustomerController::class, 'reset']);
Route::put('/customer/reset/{id}',  [CustomerController::class, 'resetPassword']);

//Staff crud
Route::get('/staff', [StaffController::class, 'index']);
Route::get('/staff/adding',  [StaffController::class, 'adding']);
Route::post('/staff',  [StaffController::class, 'create']);
Route::get('/staff/{id}',  [StaffController::class, 'edit']);
Route::put('/staff/{id}',  [StaffController::class, 'update']);
Route::delete('/staff/remove/{id}',  [StaffController::class, 'remove']);
Route::get('/staff/reset/{id}',  [StaffController::class, 'reset']);
Route::put('/staff/reset/{id}',  [StaffController::class, 'resetPassword']);

//Food crud
Route::get('/food', [FoodController::class, 'index']);
Route::get('/food/adding',  [FoodController::class, 'adding']);
Route::post('/food',  [FoodController::class, 'create']);
Route::get('/food/{id}',  [FoodController::class, 'edit']);
Route::put('/food/{id}',  [FoodController::class, 'update']);
Route::delete('/food/remove/{id}',  [FoodController::class, 'remove']);

//Pet crud
Route::get('/pet', [PetController::class, 'index']);
Route::get('/pet/adding',  [PetController::class, 'adding']);
Route::post('/pet',  [PetController::class, 'create']);
Route::get('/pet/{id}',  [PetController::class, 'edit']);
Route::put('/pet/{id}',  [PetController::class, 'update']);
Route::delete('/pet/remove/{id}',  [PetController::class, 'remove']);