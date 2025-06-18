<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/forgot', [AuthController::class, 'forgotPassword']);
Route::put('/user/edit', [AuthController::class, 'editProfile']);
Route::put('/user/changePassword', [AuthController::class, 'changePassword']);
Route::get('/products/get', [ProductController::class, 'getProducts']);
Route::get('/categories/get', [CategoryController::class, 'getCategories']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::post('/setOrder', [OrderController::class, 'setOrder']);
Route::get('/history/get', [OrderController::class, 'getHistory']);
Route::get('/products/get/{id}', [ProductController::class, 'show']);
