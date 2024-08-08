<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => ''], function () {
    Route::post('login', [AuthController::class, 'login']);
});
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'users'], function () {
    Route::post('check_has_permission/{permission}', [AuthController::class, 'checkIfHasPermission'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'tasks'], function () {
    Route::post('getAll', [TaskController::class, 'getAll'])->middleware('auth:sanctum');
    Route::post('', [TaskController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/{task}', [TaskController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->middleware('auth:sanctum');
});
