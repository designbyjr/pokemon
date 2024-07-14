<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', function(){return view('index');});

Route::post('/pokemon/search/{name}', [PokemonController::class, 'search'])->name('getPokemon');
Route::get('/pokemon/show/{id}', [PokemonController::class, 'show'])->name('pokemonOverview');
Route::get('/pokemon/index', [PokemonController::class, 'index'])->name('defaultPokemon');
