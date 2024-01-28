<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class,'register']);
// logout harus ke middleware karena harus tahu mau logoutin siapa
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class,'login']);

// categories
Route::get('/categories', [CategoryController::class, 'index']);

// products
Route::get('/products', [ProductController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
     Route::apiResource('/address', AddressController::class);
    // Route::resource('/address', ProductController::class);
});

// Route::get('/address', [AddressController::class, 'index'])->middleware('Auth:santum');

