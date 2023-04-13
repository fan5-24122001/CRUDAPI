<?php

use App\Http\Controllers\Api\PostController;
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

Route::get('students',[ PostController::class, 'index']);
Route::post('students',[ PostController::class, 'store']);
Route::get('students/{id}',[ PostController::class, 'show']);
Route::patch('students/{id}',[ PostController::class, 'update']);
Route::delete('students/{id}',[ PostController::class, 'destroy']);


