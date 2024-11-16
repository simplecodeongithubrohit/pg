<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\TenantController;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

//rent

Route::get('/buildings', [RentController::class, 'index']);
Route::post('/buildings', [RentController::class, 'store']);
Route::get('/buildings/{building}', [RentController::class, 'show']);
Route::put('/buildings/{building}', [RentController::class, 'update']);
Route::delete('/buildings/{building}', [RentController::class, 'destroy']);


//floor



Route::get('/buildings/{building}/floors', [FloorController::class, 'index']);
Route::post('/buildings/{building}/floors', [FloorController::class, 'store']);
Route::get('/buildings/{building}/floors/{floor}', [FloorController::class, 'show']);
Route::put('/buildings/{building}/floors/{floor}', [FloorController::class, 'update']);
Route::delete('/buildings/{building}/floors/{floor}', [FloorController::class, 'destroy']);

//rooms



Route::get('/floors/{floor}/rooms', [RoomController::class, 'index']);
Route::post('/floors/{floor}/rooms', [RoomController::class, 'store']);
Route::get('/floors/{floor}/rooms/{room}', [RoomController::class, 'show']);
Route::put('/floors/{floor}/rooms/{room}', [RoomController::class, 'update']);
Route::delete('/floors/{floor}/rooms/{room}', [RoomController::class, 'destroy']);
Route::get('/floors/{floor}/rooms/type/{type}', [RoomController::class, 'searchByType']);

//tenant


Route::get('/tenants', [TenantController::class, 'index']);
Route::post('/tenants', [TenantController::class, 'store']);
Route::get('/tenants/{tenant}', [TenantController::class, 'show']);
Route::put('/tenants/{tenant}', [TenantController::class, 'update']);
Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy']);
Route::post('/tenants/{tenant}/stay-details', [TenantController::class, 'storeStayDetails']);
Route::post('/tenants/{tenant}/payment-details', [TenantController::class, 'storePaymentDetails']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
