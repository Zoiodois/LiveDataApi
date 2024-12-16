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
                'UrGHouse'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100','nullable' ], 
                'tempGHouse'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100','nullable' ], 
                'lum'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:110', 'min:-100','nullable' ], 
                'sen1' => ['integer', 'numeric', 'ascii','digits_between:0,1025', 'max:1025', 'min:-100','nullable' ],
                'sen2' => ['integer', 'numeric', 'ascii','digits_between:0,1025', 'max:1025', 'min:-100','nullable' ],
                'sen3' => ['integer', 'numeric', 'ascii','digits_between:0,1025', 'max:1025', 'min:-100','nullable' ],
                'UrExternal'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100','nullable' ], 
                'tempExternal'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100','nullable' ], 
                'maxTemp'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100','nullable' ], 
                'minTemp'=> ['integer', 'numeric', 'ascii','digits_between:0,100', 'max:100', 'min:-100' ,'nullable'], 
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
