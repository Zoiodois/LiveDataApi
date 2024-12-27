<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Models\Livedata;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\WeatherapiController;

class StockController extends Controller
{
    
    public function teste(){
        return ('passou no teste');
    }

    public function newUpdateForm(Request $request){

        // Log::info('Dados recebidos no servidor:', $request->all());
        Log::info('Dados recebidos no servidor: ' . json_encode($request->all()));

        // dd($request->all());
        // return response()->json([
        //     'data' => $request
        // ]);
        
        $validator = Validator::make($request->all(), 
            [
                'batchId'=> ['required', 'numeric' ], 
                'matrixId'=> ['required', 'numeric' ], 
                'seedBankId'=> ['required', 'numeric'], 
                'idColor'=> ['string', 'ascii', 'max:110', 'min:3' ],
                'quantity'=> ['required', 'integer', 'numeric', 'digits_between:0,10000',],
                'plantDate'=> ['required','date' ],
                'endPrevision'=>['required','date' ],
                'status'=> ['required', 'string', 'ascii', 'max:110', 'min:3' ],
                'quantitySold'=> ['numeric','digits_between:-1,10000', 'max:10000','nullable'],
                'quantityDead'=>['integer', 'numeric','digits_between:0,10000', 'max:10000', 'min:0','nullable'],
                'observation'=> ['string', 'ascii', 'max:1000','nullable'],
                'displayName'=> ['required', 'string', 'ascii', 'max:110', 'min:3' ],
            ]);

            if($validator->fails()){
                return response()->json([
                    'errors' => $validator->errors()->getMessages(),
                ], 400); 
            }
            
            $validated = $validator->validated();

            $updated = Stock::find($id)->update([
                'batchId'=> $validated['batchId' ], 
                'matrixId'=>$validated ['matrixId' ], 
                'seedBankId'=>$validated ['seedBankId'], 
                'idColor'=> $validated['idColor' ],
                'quantity'=>$validated ['quantity'],
                'plantDate'=> $validated['plantDate' ],
                'endPrevision'=>$validated['endPrevision' ],
                'status'=> $validated['status' ],
                'quantitySold'=> $validated['quantitySold'],
                'quantityDead'=>$validated['quantityDead'],
                'observation'=> $validated['observation'],
                'displayName'=> $validated['displayName' ],
        
            ]);

            if($updated){
                //A mensagem de sucesso nao esta funcionando
                return $this->show();
            };

            return ('Atualização Falhou');

    }

    public function updateForm(Request $request){

        // $data = $request->json()->all();

        // return response()->JSON(
        //     [
        //         'status' => $data,
        //     ], 400);
    
        $validator = Validator::make($request->json()->all(), 
            [
                'batchId'=> ['required', 'numeric' ], 
                'matrixId'=> ['required', 'numeric' ], 
                'seedBankId'=> ['required', 'numeric'], 
                'idColor'=> ['string', 'ascii', 'max:110', 'min:3' ],
                'quantity'=> ['required', 'integer', 'numeric', 'digits_between:0,10000',],
                'plantDate'=> ['required','date' ],
                'endPrevision'=>['required','date' ],
                'status'=> ['required', 'string', 'ascii', 'max:110', 'min:3' ],
                'quantitySold'=> ['numeric','digits_between:-1,10000', 'max:10000','nullable'],
                'quantityDead'=>['integer', 'numeric','digits_between:0,10000', 'max:10000', 'min:0','nullable'],
                'observation'=> ['string', 'ascii', 'max:1000','nullable'],
                'displayName'=> ['required', 'string', 'ascii', 'max:110', 'min:3' ],
            ]);

            if($validator->fails()){
                return response()->JSON(
                    [
                        'errors' => $validator->errors()->getMessages(),
                    ], 400);
            }

            $validated = $validator->validated();
            $id = $request->input('id');

            $updated = Stock::findOrFail($id)->update([
                'batchId'=> $validated['batchId' ], 
                'matrixId'=>$validated ['matrixId' ], 
                'seedBankId'=>$validated ['seedBankId'], 
                'idColor'=> $validated['idColor' ],
                'quantity'=>$validated ['quantity'],
                'plantDate'=> $validated['plantDate' ],
                'endPrevision'=>$validated['endPrevision' ],
                'status'=> $validated['status' ],
                'quantitySold'=> $validated['quantitySold'],
                'quantityDead'=>$validated['quantityDead'],
                'observation'=> $validated['observation'],
                'displayName'=> $validated['displayName' ],
        
            ]);

            $stock = Stock::findOrFail($id);
            if($updated){
                return response()->json([
                    'success' => $stock
                ], 201);
            }
                
    }


    public function editProdForm(Stock $prod){

        return view('editProd', ['stock' => $prod]);
    }


    public function postProduction(Request $request){
      
        //Will post by form startly
        $incomingfields = $request->validate([
            'batchId'=> ['required', 'numeric' ], 
            'matrixId'=> ['required', 'numeric' ], 
            'seedBankId'=> ['required', 'numeric'], 
            'idColor'=> ['String', 'ascii', 'max:110', 'min:3' ],
            'quantity'=> ['required', 'integer', 'numeric', 'ascii','digits_between:0,10000',],
            'plantDate'=> ['required','date' ],
            'endPrevision'=>['required','date' ],
            'status'=> ['required', 'String', 'ascii', 'max:110', 'min:3' ],
            'quantitySold'=> ['numeric', 'ascii','digits_between:-1,10000', 'max:10000','nullable'],
            'quantityDead'=>['integer', 'numeric', 'ascii','digits_between:0,100', 'max:10000', 'min:0','nullable'],
            'observation'=> ['String', 'ascii', 'max:1000','nullable'],
            'displayName'=> ['required', 'String', 'ascii', 'max:110', 'min:3' ],
    
        ]);
    
        Stock::create($incomingfields);

        return $this->showdata();
    }

    public function showProdForm(){
        
        return view('stockProdForm');
        
    }


    public function importCsv(Request $request)
    {
        // Valida se o arquivo foi enviado
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // Lê o arquivo CSV
        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();

        // Abre o arquivo para leitura
        $data = array_map('str_getcsv', file($filePath));
        $header = $data[0]; // Primeira linha é o cabeçalho
        unset($data[0]); // Remove o cabeçalho dos dados

        // Insere os dados no banco
        foreach ($data as $row) {
            $rowData = array_combine($header, $row); // Associa o cabeçalho às colunas
            // Verifica se o batchId já existe
            if (!Stock::where('batchId', $rowData['batchId'])->exists()) {
                // Apenas insere se o batchId não existir
                Stock::create([
                    'batchId' => $rowData['batchId'],
                    'matrixId' => $rowData['matrixId'],
                    'seedBankId' => $rowData['seedBankId'],
                    'idColor' => $rowData['idColor'],
                    'quantity' => $rowData['quantity'],
                    'plantDate' => Carbon::createFromFormat('Y-m-d', $rowData['plantDate'])->format('Y-m-d'),
                    'endPrevision' => Carbon::createFromFormat('Y-m-d', $rowData['endPrevision'])->format('Y-m-d'),
                    'status' => $rowData['status'],
                    'quantitySold' => $rowData['quantitySold'],
                    'quantityDead' => $rowData['quantityDead'],
                    'observation' => $rowData['observation'],
                    'displayName' => $rowData['displayName'],
                ]);
            }
        }

        return redirect()->route('home')->with('success', 'CSV importado com sucesso!');
    }

    public function exemple() {
        $stock = Stock::whereNotIn('status', ['finalizado', 'Finalizado'])->get(); 
        return view('example', ['stock' => $stock]);
    }




    public function show(){
        //MOVE THIS FUNCTION TO A NEW CONTROLLER
        //Live Data Filter
        $latestedLiveData =  Livedata::latest()->first();

        $transformFields = ['lastCycleEpoch','lastIr1Epoch','lastIr2Epoch','lastIr3Epoch',
                            'lastIr4Epoch','lastIr5Epoch','lastCycleStart'];

        $formatedEpoch = [];

        foreach ($transformFields as $key){
            $sendfield = $latestedLiveData[$key];
            $carbonEpoch = \Carbon\Carbon::createFromTimestamp($sendfield);
            $formatedEpoch[$key]['data'] = $carbonEpoch->format('d-m-Y');
            $formatedEpoch[$key]['time'] = $carbonEpoch->format('H:i:s');

        }

        //Stock Controll Filter
        $stock = Stock::whereNotIn('status', ['finalizado', 'Finalizado'])->get();  //Filter data with ! = Finalizado, at column 'status'
        // $stock = Stock::latest()->first();  //Filter data with ! = Finalizado, at column 'status'
       
        $weather = (new WeatherapiController)->getdata();

        // dd($weather);
        
        return view('content',[
            'tranformedEpochs' => $formatedEpoch,
            'liveData' => $latestedLiveData,
            'stock' => $stock,
            'weather' => $weather
            //create filter here
    
    
        ]);
}

}


