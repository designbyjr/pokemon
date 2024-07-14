<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Helpers\PokemonHelper;
class PokemonController extends Controller
{
    public function getPokemon($name)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");

        if ($response->successful()) {
            $data = $response->json();
            $helper = new PokemonHelper();
            $response = $helper->TransposeSearchResponse($data);
            return response()->json($response);
        } else {
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }

    public function getDefaultPokemon()
    {
        // Example: Fetch default Pokémon, e.g., "pikachu"
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/?limit=1350");

        if ($response->successful()) {
            $data = $response->json();
            $helper = new PokemonHelper();
            $response = $helper->TransposeDefaultResponse($data['results']);
            return response()->json($response);
        } else {
            return response()->json(['error' => 'Default Pokemon not found'], 404);
        }
    }
}
