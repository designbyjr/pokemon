<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', function(){return view('welcome');});

Route::post('/pokemon/search/{name}', [PokemonController::class, 'getPokemon'])->name('getPokemon');
Route::get('/pokemon/fetch/{id}', [PokemonController::class, 'getPokemonOverview'])->name('pokemonOverview');
Route::get('/pokemon/default', [PokemonController::class, 'getDefaultPokemon'])->name('defaultPokemon');
