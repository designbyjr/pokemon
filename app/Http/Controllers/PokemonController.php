<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Helpers\PokemonHelper;

/**
 * @OA\Info(title="Pokemon API", version="1.0")
 */
class PokemonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/pokemon",
     *     operationId="index",
     *     tags={"pokemon"},
     *     summary="Get list of all Pokemon",
     *     description="Returns a list of all Pokemon",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="array", @OA\Items(type="object"))
     *     )
     * )
     */
    public function index()
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/?limit=1350");

        if ($response->successful()) {
            $data = $response->json();
            $helper = new PokemonHelper();
            $transposedResponse = $helper->transposeDefaultResponse($data['results']);
            return response()->json($transposedResponse);
        } else {
            return response()->json(['error' => 'Default Pokemon not found'], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/pokemon/{name}",
     *     operationId="show",
     *     tags={"pokemon"},
     *     summary="Get Pokemon by name",
     *     description="Returns Pokemon details by name",
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="Name of the Pokemon",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pokemon not found",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     )
     * )
     */
    public function show($id)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");

        if ($response->successful()) {
            $data = $response->json();
            $helper = new PokemonHelper();
            $transposedResponse = $helper->transposeOverviewResponse($data);
            return response()->json($transposedResponse);
        } else {
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/pokemon/search",
     *     operationId="search",
     *     tags={"pokemon"},
     *     summary="Search Pokemon",
     *     description="Search Pokemon by name",
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         description="Search query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="array", @OA\Items(type="object"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pokemon not found",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     )
     * )
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$query}");

        if ($response->successful()) {
            $data = $response->json();
            $helper = new PokemonHelper();
            $transposedResponse = $helper->transposeSearchResponse($data);
            return response()->json($transposedResponse);
        } else {
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/pokemon",
     *     operationId="store",
     *     tags={"pokemon"},
     *     summary="Store a new Pokemon",
     *     description="Creates a new Pokemon entry",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pokemon created successfully",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     )
     * )
     */


    public function store(Request $request)
    {
        // Implementation for storing a new Pokemon entry
        return response()->json(['message' => 'Pokemon created successfully'], 201);
    }

    /**
     * @OA\Put(
     *     path="/pokemon/{name}",
     *     operationId="update",
     *     tags={"pokemon"},
     *     summary="Update an existing Pokemon",
     *     description="Updates an existing Pokemon entry",
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="Name of the Pokemon",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pokemon updated successfully",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pokemon not found",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     )
     * )
     */
    public function update(Request $request, $name)
    {
        // Implementation for updating an existing Pokemon entry
        return response()->json(['message' => 'Pokemon updated successfully']);
    }

    /**
     * @OA\Delete(
     *     path="/pokemon/{name}",
     *     operationId="destroy",
     *     tags={"pokemon"},
     *     summary="Delete a Pokemon",
     *     description="Deletes a Pokemon by name",
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="Name of the Pokemon",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pokemon deleted successfully",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pokemon not found",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     )
     * )
     */
    public function destroy($name)
    {
        // Implementation for deleting a Pokemon entry
        return response()->json(['message' => 'Pokemon deleted successfully']);
    }
}
