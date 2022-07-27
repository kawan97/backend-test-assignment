<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::post('/admin/create', [AdminController::class, 'store']);
Route::get('/admin/resources', [AdminController::class, 'index']);
Route::delete('/admin/resources/{id}', [AdminController::class, 'destroy']);
Route::put('/admin/resources/{id}', [AdminController::class, 'update']);


