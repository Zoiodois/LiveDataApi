<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Models\Livedata;
use Illuminate\Http\Request;

class LivedataController extends Controller
{
    public function postlivedata(Request $request){

        // \Log::info('Dados recebidos:', [
        //     'method' => $request->method(),
        //     'path' => $request->path(),
        //     'all_data' => $request->all()
        // ]);
    
            // Validação dos dados recebidos
            //Verificar aqui e no banco de dados, caso os valores venham acima do esperado, o que fazer.. Criar integers maiores
            $validated = $request->validate([
                'UrGHouse'=> ['integer', 'numeric', 'ascii','digits_between:-100,10000', 'max:10000', 'min:-100','nullable' ], 
                'tempGhouse'=> ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ], 
                'moduleTemp'=> ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ], 
                'lum'=> ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ], 
                'sen1' => ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ], //tinyInteger. up to 128
                'sen2' => ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ],
                'sen3' => ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ],
                'UrExternal'=> ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ], 
                'tempExternal'=> ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ], 
                'maxTemp'=> ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100','nullable' ], 
                'minTemp'=> ['integer', 'numeric', 'ascii','digits_between:0,10000', 'max:10000', 'min:-100' ,'nullable'], 
                'lastCycleEpoch' => ['integer', 'numeric', 'ascii','nullable'],
                'lastIr1Epoch' => ['integer', 'numeric', 'ascii','nullable'],
                'lastIr2Epoch' => ['integer', 'numeric', 'ascii','nullable'],
                'lastIr3Epoch' => ['integer', 'numeric', 'ascii','nullable'],
                'lastIr4Epoch' => ['integer', 'numeric', 'ascii','nullable'],
                'lastIr5Epoch' => ['integer', 'numeric', 'ascii','nullable'],
                'lastCycleStart' => ['integer', 'numeric', 'ascii','nullable'],
                'queue' => ['ascii','nullable']
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