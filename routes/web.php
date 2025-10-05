<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('whitelist')
    ->controller(SeasonController::class)
    ->group(function () {
        Route::get('/season', 'index')->name('season.index');
        Route::get('/season/create', 'create')->name('season.create');
        Route::post('/season', 'store')->name('season.store');
        Route::get('/season/{id}/edit', 'edit')->name('season.edit');
        Route::put('/season/{id}', 'update')->name('season.update');
        Route::delete('/season/{id}', 'destroy')->name('season.destroy');
    });

Route::middleware('whitelist')
    ->controller(AnimeController::class)
    ->group(function () {
        Route::get('/anime', 'index')->name('anime.index');
        Route::get('/anime/create', 'create')->name('anime.create');
        Route::post('/anime', 'store')->name('anime.store');
        Route::get('/anime/{id}/edit', 'edit')->name('anime.edit');
        Route::put('/anime/{id}', 'update')->name('anime.update');
        Route::delete('/anime/{id}', 'destroy')->name('anime.destroy');
    });

Route::get('/my-ip', function (Request $request) {
    return "IP kamu: " . $request->ip();
});