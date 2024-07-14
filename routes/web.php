<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Middleware\ForceJsonResponse;

Route::get('/', function(){return view('index');})->name("home");
Route::get('/overview/{id}', function($id){return view('overview',['id' => $id]);})->name("overview");

Route::group(['middleware' => ForceJsonResponse::class], function () {
    Route::post('/pokemon/search/{name}', [PokemonController::class, 'search'])->name('getPokemon');
    Route::post('/pokemon/show/{id}', [PokemonController::class, 'show'])->name('pokemonbyid');
    Route::get('/pokemon/index', [PokemonController::class, 'index'])->name('defaultPokemon');
});
