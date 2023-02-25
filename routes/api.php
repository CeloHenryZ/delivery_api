<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    //auth
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
    Route::post('logout',   [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('me',       [AuthController::class, 'me']);

    //categories
    Route::post('registerCategory',             [CategoryController::class, 'store']);
    Route::get('listCategories',                [CategoryController::class, 'index']);
    Route::get('showCategory/{id_category}',    [CategoryController::class, 'show']);
    Route::post('updateCategory/{id_category}', [CategoryController::class, 'update']);
    Route::post('inactivateCategory',           [CategoryController::class, 'inactivate']);


});
