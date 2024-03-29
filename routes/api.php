<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItenerariesController;

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
Route::post('register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/itinerary', [ItenerariesController::class, 'store']);
    Route::put('/itinerary/{itinerary}', [ItenerariesController::class, 'update']);
    Route::delete('/itinerary/{itinerary}', [ItenerariesController::class, 'destroy']);
    Route::get('/itineraries/search', [ItenerariesController::class, 'search']);
});
Route::post('/itinerary/{itinerary}/destination', [ItenerariesController::class, 'addDestination']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);
