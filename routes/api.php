<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;


// authentication of the user 

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);
});


// if user admin

Route::group(

    ['middleware' => ['auth:sanctum', 'role:admin']],

    function () {
        Route::resource('genre', GenresController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);
    }
);


// if uuser registered

Route::group(

    ['middleware' => ['auth:sanctum']],

    function () {
        Route::resource('show', ShowController::class)->only([
            'index', 'show', 'store',  'destroy'
        ]);

        Route::get('/get-new-message', [MessageController::class, 'getMessage']);
        Route::post('/messages/{id}/accept', [MessageController::class, 'acceptShow']);
        Route::delete('/messages/{id}/reject', [MessageController::class, 'rejectShow']);
        Route::get('/messages/accepted', [MessageController::class, 'acceptedShows']);
    }
);

//  the routes can see user if not logged

Route::get('/update-complate-shows', [ShowController::class, 'updateIsComplete']);
Route::get('/get-complate-shows', [ShowController::class, 'getCompletedShows']);
Route::get('/get-uncomplate-shows', [ShowController::class, 'getUnCompletedShows']);
