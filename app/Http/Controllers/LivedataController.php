<?php

namespace App\Http\Controllers;

use App\Models\Livedata;
use Illuminate\Http\Request;

class LivedataController extends Controller
{
    public function postlivedata(Request $request){

            \Log::info('Dados recebidos:', $request->all());

            // Validação dos dados recebidos
            $validated = $request->validate([
                'UrGHouse'=> ['required', 'integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'tempGHouse'=> ['required', 'integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'lum'=> ['required', 'integer', 'numeric', 'ascii','digits_between:0,100', 'max:110', 'min:-100' ], 
            ]);
    
            // Armazenamento no banco de dados
            Livedata::create($validated);
    
            // Retorna uma resposta de sucesso
            return response()->json(['message' => 'Data stored successfully'], 200);
    }
}
