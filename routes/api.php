<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('login', [AuthController::class, 'login']);



Route::delete('posts/images/{image}', [PostController::class, 'deleteImage']);
Route::post('posts/images', [PostController::class, 'postImage']);
Route::apiResource('posts', PostController::class);
Route::apiResource('posts.comments', CommentController::class)->shallow();

Route::any('/{any}', function(){
    return response("Not Found", 404);
})->where('any', '.*');