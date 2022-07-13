<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'notes'], function () {
    Route::get('/', [NoteController::class, 'index']);
    Route::post('/', [NoteController::class, 'store']);
    Route::get('/{id}', [NoteController::class, 'show']);
    Route::put('/{id}', [NoteController::class, 'update']);
    Route::delete('/{id}', [NoteController::class, 'destroy']);
});

Route::group(['prefix' => 'items'], function () {
    Route::get('/', [ItemController::class, 'index']);
});

Route::group(['prefix' => 'customers'], function () {
    Route::get('/', [CustomerController::class, 'index']);
});
