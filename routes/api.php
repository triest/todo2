<?php

use App\Http\Controllers\AnketController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\Api\ToDoItemController;
use App\Http\Controllers\Api\ToDoListController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::middleware('api')->group(function () {

});


Route::middleware('auth')->group(
        function () {
            Route::apiResource('to-do-list-item', ToDoItemController::class);
            Route::apiResource('to-do-list', ToDoListController::class);
            Route::apiResource('tag', TagController::class);
        }
);



