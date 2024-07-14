<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Middleware\ForceJsonResponse;

Route::get('/', function(){return view('index');});

Route::group(['middleware' => ForceJsonResponse::class], function () {
    Route::post('/pokemon/search/{name}', [PokemonController::class, 'search'])->name('getPokemon');
    Route::get('/pokemon/show/{id}', [PokemonController::class, 'show'])->name('pokemonOverview');
    Route::get('/pokemon/index', [PokemonController::class, 'index'])->name('defaultPokemon');
});
