<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Models\Livedata;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StockController extends Controller
{
    
    public function reallyEditProdForm(Stock $stock, Request $request){

       if( Auth::attempt($request->user())){

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

        $stock->update($incomingfields);

        return $this->showdata();

       }


        return ('You are not Logged In');



    }


    public function editProdForm(Stock $prod){

        return view('editStockProd', ['stock' => $prod]);
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
    
    
        // return $this->showdata();
        return $this->showdata();
    }

    public function showdata(){
        
        $data = Stock::all();

        return view('stockdata', [
            'stock' => $data
           
        ]);
        
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





    public function show(){
        //MOVE THIS FUNCTION TO A NEW CONTROLLER
        //Live Data Filter
        $latestedLiveData =  Livedata::latest()->first();

        $transformFields = ['lastCycleEpoch','lastIr1Epoch','lastIr2Epoch','lastIr3Epoch',
                            'lastIr4Epoch','lastIr5Epoch','lastCycleStart'];

        $filteredLiveData = [];

        foreach ($transformFields as $key){
            $sendfield = $latestedLiveData[$key];
            $carbonEpoch = \Carbon\Carbon::createFromTimestamp($sendfield);
            $filteredLiveData[$key]['data'] = $carbonEpoch->format('d-m-Y');
            $filteredLiveData[$key]['time'] = $carbonEpoch->format('H:i:s');

        }

        //Stock Controll Filter
        $stock = Stock::all(); //Filter data with ! = Finalizado, at column 'status'

        return view('content',[
            'tranformedEpochs' => $filteredLiveData,
            'liveData' => $latestedLiveData,
            'stock' => $stock
            //create filter here
    
    
        ]);
}

}


