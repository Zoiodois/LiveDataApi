<?php

namespace App\Http\Controllers;

use App\Models\Livedata;
use Illuminate\Http\Request;

class LivedataController extends Controller
{
    public function postlivedata(Request $request){

        \Log::info('Dados recebidos:', [
            'method' => $request->method(),
            'path' => $request->path(),
            'all_data' => $request->all()
        ]);
    
            // Validação dos dados recebidos
            $validated = $request->validate([
                'UrGHouse'=> ['required', 'integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'tempGHouse'=> ['required', 'integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'lum'=> ['required', 'integer', 'numeric', 'ascii','digits_between:0,100', 'max:110', 'min:-100' ], 
            ]);
    
            // Armazenamento no banco de dados
           if(Livedata::create($validated)){
               
               // Retorna uma resposta de sucesso
               return response()->json([
                   'status' => 'success',
                   'data' => $request->all()
               ]);
           }

           return respose()->json([
            'status' => 'fail',
            
           ]);
    
    }
}
