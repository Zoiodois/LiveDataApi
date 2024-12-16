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
                'UrGHouse'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'tempGHouse'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'lum'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:110', 'min:-100' ], 
                'sen1' => ['integer', 'numeric', 'ascii','digits_between:0,1025', 'max:1025', 'min:-100' ],
                'sen2' => ['integer', 'numeric', 'ascii','digits_between:0,1025', 'max:1025', 'min:-100' ],
                'sen3' => ['integer', 'numeric', 'ascii','digits_between:0,1025', 'max:1025', 'min:-100' ],
                'UrExternal'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'tempExternal'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'maxTemp'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'minTemp'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ], 
                'lastCycleEpoch' => ['integer', 'numeric', 'ascii'],
                'lastIr1Epoch' => ['integer', 'numeric', 'ascii'],
                'lastIr2Epoch' => ['integer', 'numeric', 'ascii'],
                'lastIr3Epoch' => ['integer', 'numeric', 'ascii'],
                'lastIr4Epoch' => ['integer', 'numeric', 'ascii'],
                'lastIr5Epoch' => ['integer', 'numeric', 'ascii'],
                'lastCycleStart' => ['integer', 'numeric', 'ascii'],
                'queue' => ['ascii']
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
