<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UploadController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    [
        'middleware' => 'api',

    ],
    function ($router) {
        Route::post('signup', [AuthController::class, 'signup']);
        Route::post('signin', [AuthController::class, 'signin']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('getUser', [AuthController::class, 'getUser']);


    }
);
Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'tweet'
    ],
    function ($router) {
        Route::post('create', [TweetController::class, 'createTweet']);
        Route::post('update', [TweetController::class, 'updateTweet']);
        Route::post('delete', [TweetController::class, 'deleteTweet']);
        Route::post('followuser', [FollowUserController::class, 'followuserornot']);
        Route::post('listuser', [FollowUserController::class, 'followedList']);
        Route::post('recommendList', [FollowUserController::class, 'recommendedList']);


    }
);
Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'upload'
    ],
    function ($router) {
        Route::post('uploadFile', [UploadController::class, 'uploadFile']);

    }
);