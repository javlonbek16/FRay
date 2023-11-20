<?php

use App\Http\Controllers\ArtistFilter;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\VenueFilter;
use Illuminate\Support\Facades\Route;

// authentication of the user 

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);
});

// if user admin
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::resource('genre', GenresController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);
});

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

// artist filters 

Route::prefix('artist')->group(function () {

    Route::get('/', [ArtistFilter::class, 'index']);

    Route::get('{artist_id}/complete-shows', [ArtistFilter::class, 'artistCompleteShows']);

    Route::get('{artist_id}/incomplete-shows', [ArtistFilter::class, 'artistIncompleteShows']);

    Route::get('{artist_id}/', [ArtistFilter::class, 'showArtist']);
});

// venue filters 

Route::prefix('venue')->group(function () {

    Route::get('/', [VenueFilter::class, 'index']);

    Route::get('{venue_id}/complete-shows', [VenueFilter::class, 'venueCompleteShows']);

    Route::get('{venue_id}/incomplete-shows', [VenueFilter::class, 'venueIncompleteShows']);

    Route::get('{venue_id}/', [VenueFilter::class, 'showVenue']);
});


Route::get('/update-complate-shows', [ShowController::class, 'updateIsComplete']);

Route::get('/filter', [FilterController::class, 'getShows']);
