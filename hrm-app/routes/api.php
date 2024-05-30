<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PersonnelController;
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

Route::post('login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [PersonnelController::class, 'index'])->middleware('permission:users.list'); 
        Route::post('/', [PersonnelController::class, 'store'])->middleware('permission:users.create');
        Route::get('/{user}', [PersonnelController::class, 'show'])->middleware('permission:users.view');
        Route::put('/{user}', [PersonnelController::class, 'update'])->middleware('permission:users.update');
        Route::delete('/{user}', [PersonnelController::class, 'destroy'])->middleware('permission:users.delete'); 
    });
});
