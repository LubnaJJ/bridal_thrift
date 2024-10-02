<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController; // Make sure to include this
use App\Http\Controllers\ProductController; // Import the ProductController

// Authentication routes
Route::post('signup', [AuthController::class, 'signup']);
Route::post('signin', [AuthController::class, 'signin']);

Route::post('/business/signup', [BusinessController::class, 'signup']);
Route::post('/business/login', [BusinessController::class, 'login']);

// Product routes
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);


Route::get('/businesses', [BusinessController::class, 'index']);
Route::get('/businesses/{id}', [BusinessController::class, 'show']);
Route::post('/products/rent', [ProductController::class, 'rentProduct']);


// This route is to get the authenticated user's data
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
