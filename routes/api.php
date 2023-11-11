<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);
});


Route::group(

    ['middleware' => ['auth:sanctum', 'role:admin']],


    function () {
    }
);

Route::resource('genre', GenresController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);
Route::group(

    ['middleware' => ['auth:sanctum']],

    function () {
        Route::resource('show', ShowController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::get('/get-new-message', [MessageController::class, 'getMessage']);
    }
);

Route::get('/update-complate-shows', [ShowController::class, 'updateIsComplete']);
Route::get('/get-complate-shows', [ShowController::class, 'getCompletedShows']);
Route::get('/get-uncomplate-shows', [ShowController::class, 'getUnCompletedShows']);
