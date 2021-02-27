<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Gallery routes

Route::get('/', [GalleriesController::class, 'index'])->middleware('guest:api');
Route::get('/galleries/{id}', [GalleriesController::class, 'show'])->middleware('auth:api');
Route::post('/create', [GalleriesController::class, 'store'])->middleware('auth:api');
Route::put('/edit-gallery/{id}',[GalleriesController::class, 'update'])->middleware('auth:api');
Route::delete('/galleries/{id}', [GalleriesController::class, 'destroy'])->middleware('auth:api');

// User routes

Route::post('/register', [AuthController::class, 'register'])->middleware('guest:api');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest:api');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/user',[AuthController::class, 'me'])->middleware('auth:api');
