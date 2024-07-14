<?php
namespace Helpers;

class PokemonHelper
{

    public static function getId($url)
    {
        $pattern = '/pokemon\/(\d+)/';;
        preg_match($pattern, $url, $matches);
        return $matches[1];
    }

    public static function getDefaultImage($url):int
    {
        $pattern = '/\d+/';
        preg_match($pattern, $url, $matches);
        return $matches[0];
    }

    public static function getName($url):int
    {
        $pattern = '/\d+/';
        preg_match($pattern, $url, $matches);
        return $matches[0];
    }

    public static function getSpecies($url):int
    {
        $pattern = '/\d+/';
        preg_match($pattern, $url, $matches);
        return $matches[0];
    }

    public static function getHeight($url):int
    {
        $pattern = '/\d+/';
        preg_match($pattern, $url, $matches);
        return $matches[0];
    }

    public static function getWeight($url):int
    {
        $pattern = '/\d+/';
        preg_match($pattern, $url, $matches);
        return $matches[0];
    }

    public static function getAbilities($url):int
    {
        $pattern = '/\d+/';
        preg_match($pattern, $url, $matches);
        return $matches[0];
    }

    public function transposeDefaultResponse($response)
    {
        $imgBasePath = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/';
        foreach ($response as $pokemon)
        {
            $id = self::getId($pokemon['url']);
            $data[] = [
                'id' => $id,
                'name'=> $pokemon['name'],
                'url' => route('overview',['id'=>$id]),
                'image' => $imgBasePath.$id.'.png'
                ];
        }
        return $data;
    }

    public function transposeSearchResponse($response)
    {
        $imgBasePath = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/';
        $id = $response["id"];
        $data[] = [
                'id' => $id,
                'name'=> $response["species"]['name'],
                'url' => route('overview',['id'=>$id]),
                'image' => $imgBasePath.$id.'.png'
            ];

        return $data;
    }

    public function transposeOverviewResponse($response)
    {
        $imgBasePath = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/';
        $id = $response["id"];
        $data[] = [
            'id' => $id,
            'name'=> strtoupper($response["species"]["name"]),
            'url' => route('overview',['id'=>$id]),
            'image' => $imgBasePath.$id.'.png',
            "species" => strtoupper($response["species"]["name"]),
            "height"=> $response["height"],
            "weight"=> $response["weight"],
            "base_experience"=> $response["base_experience"],
            "abilities" => $response["abilities"]

        ];

        return $data;
    }
}
