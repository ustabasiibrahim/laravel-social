<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Sosyovito API',
        'status' => 'success',
        'version' => '1.0.0',
    ]);
});

Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('posts', PostsController::class);
