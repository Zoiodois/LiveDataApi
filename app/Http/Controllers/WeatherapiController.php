<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherapiController extends Controller
{
    //Aqui será feita a requisição do Weather API para display no frontend/
    //Provavelmente futuramente sera feito via javascrip


    public function getData(){

        $url = "https://api.openweathermap.org/data/2.5/weather?lat=-25.140915&lon=-50.213898&appid=5c2ff3f9cf1d4fa9895fb9004d04b9c7";
        $response = @file_get_contents($url); // @ suprime erros visíveis, mas trate o erro abaixo
           
        if ($response === FALSE) {
            $dataShow = "Erro ao conectar à API.";
        } else {
            // Decodificar o JSON
            $data = json_decode($response, true);

            return [
                'temperatura' => $data['main']['temp'] - 273.15,
                'sensacao' => $data['main']['feels_like'] - 273.15,
                'min_temp' => $data['main']['temp_min'] - 273.15,
                'max_temp' => $data['main']['temp_max'] - 273.15,
                'pressao' => $data['main']['pressure'],
                'umidade_relativa' => $data['main']['humidity'],
                'altitude' => $data['main']['grnd_level'] ?? null, // Campo opcional
            ];

            //For error debbuging
            // if (json_last_error() === JSON_ERROR_NONE) {
            //     // Exibir o array de forma legível
            //     $dataShow = "<pre>" . print_r($data, true) . "</pre>";
            // } else {
            //     $dataShow = "Erro ao decodificar JSON.";
            // }
            
    

        }







    }



}
