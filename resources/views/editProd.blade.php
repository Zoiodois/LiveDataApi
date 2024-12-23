@extends('master')

@section('content')
    
    {{-- <h2>Area de teste</h2>

    <x-form method="post" action="/editProdForm">
    
        
    
    </x-form> --}}


    <h1>Editar uma produção</h1>
  
        

    <form action="/editProdForm/{{$stock->id}}" method="POST">

        @csrf
        @method('PATCH')
       
        <div>
            <label for="displayName">Display Name:</label>
            <input name="displayName" type="text" placeholder="Display Name" value="{{ $stock->displayName }}">
                    @error('displayName')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="batchId">ID do Lote:</label>
            <input name="batchId" type="number" placeholder="ID do Lote" value="{{ $stock->batchId }}">
            @error('batchId')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="matrixId">ID da Matriz:</label>
            <input name="matrixId" type="number" placeholder="ID da Matriz" value="{{ $stock->matrixId }}">
            @error('matrixId')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="seedBankId">ID do Banco de Sementes:</label>
            <input name="seedBankId" type="number" placeholder="ID do Banco de Sementes" value="{{ $stock->seedBankId}}">
            @error('seedBankId')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="idColor">Cor de Identificação:</label>
            <input name="idColor" type="text" placeholder="Cor de Identificação" value="{{ $stock->idColor }}">
            @error('idColor')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="quantity">Quantidade:</label>
            <input name="quantity" type="number" placeholder="Quantidade" value="{{ $stock->quantity }}">
            @error('quantity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="plantDate">Data de Plantio:</label>
            <input type="date" name="plantDate" placeholder="Data de Plantio" value="{{ $stock->plantDate }}">
            @error('plantDate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="endPrevision">Previsão de Termino:</label>
            <input type="date" name="endPrevision" placeholder="Previsão de Termino" value="{{ $stock->endPrevision }}">
            @error('endPrevision')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="status">Localização:</label>
            <input name="status" type="text" placeholder="Localização" value="{{ $stock->status }}">
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="quantitySold">Quantidade Vendida:</label>
            <input name="quantitySold" type="number" placeholder="Quantidade Vendida" value="{{ $stock->quantitySold}}">
            @error('quantitySold')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="quantityDead">Quantidade Morta:</label>
            <input name="quantityDead" type="number" placeholder="Quantidade Morta" value="{{ $stock->quantityDead }}">
            @error('quantityDead')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div>
            <label for="observation">Observação:</label>
            <input name="observation" type="text" placeholder="Observação" value="{{ $stock->observation }}">
            @error('observation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
            @auth
 
                <button type="submit">Manda Arrumado!</button>
    </form>
       
            @else
    
    </form>
            
            <span style="padding: 50px">Faça Login para realizar Edições</span>
            <div style="width: 100px; padding:20px;">
                <form action="/login" method="GET">
                <button>Log In</button>              
            </div>

            @endauth
    
@endsection
