@extends('master')

@section('content')
{{-- 
    
<h1>Preencha os Campos para incluir uma Produção no Estoque</h1>
<h2>Essa pagina só podera ser vista por usuarios Logados</h2>
<h2>Esse formulario tem que ser passado via Blade</h2> --}}

<h3>Incluir nova Planta em Produção:</h3>
<x-productionForm method="POST" action="/stock">  
    @csrf
   
    <x-forms.inputText name="displayName" type="text" label="Display Name" placeholder="Must be Unique" />
    <x-forms.inputText name="batchId" type="number" label="ID do Lote" placeholder="Batch Id" />
    <x-forms.inputText name="matrixId" type="number" label="ID da Matriz" placeholder="Batch Id" />
    <x-forms.inputText name="seedBankId" type="number" label="ID do Lote" placeholder="ID do Banco de Sementes" />
    <x-forms.inputText name="idColor" type="text" label="Cor de Identificação" placeholder="Cor de Identificação" />
    <x-forms.inputText name="quantity" type="number" label="Quantidade" placeholder="Quantidade" />
    <x-forms.inputText name="plantDate" type="date" label="Data de Plantio" />
    <x-forms.inputText name="endPrevision" type="date" label="Data de Termino" />
    <x-forms.inputText name="status" type="text" label="Localização" />
    <x-forms.inputText name="quantitySold" type="number" label="Quantidade Vendida" />
    <x-forms.inputText name="quantityDead" type="number" label="Quantidade Morta" />
    <x-forms.inputText name="observation" type="text" label="Observação" />
    
</x-productionForm>



{{-- <form action="/stock" method="POST">
        @csrf
        
        <div>
            <label for="displayName">Display Name:</label>
            <input name="displayName" type="text" placeholder="Display Name" value="{{ old('displayName') }}">
            @error('displayName')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="batchId">ID do Lote:</label>
            <input name="batchId" type="number" placeholder="ID do Lote" value="{{ old('batchId') }}">
            @error('batchId')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="matrixId">ID da Matriz:</label>
                <input name="matrixId" type="number" placeholder="ID da Matriz" value="{{ old('matrixId') }}">
                @error('matrixId')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="seedBankId">ID do Banco de Sementes:</label>
                <input name="seedBankId" type="number" placeholder="ID do Banco de Sementes" value="{{ old('seedBankId') }}">
                @error('seedBankId')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="idColor">Cor de Identificação:</label>
                <input name="idColor" type="text" placeholder="Cor de Identificação" value="{{ old('idColor') }}">
                @error('idColor')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="quantity">Quantidade:</label>
                <input name="quantity" type="number" placeholder="Quantidade" value="{{ old('quantity') }}">
                @error('quantity')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="plantDate">Data de Plantio:</label>
                <input type="date" name="plantDate" placeholder="Data de Plantio" value="{{ old('plantDate') }}">
                @error('plantDate')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div>
                <label for="endPrevision">Previsão de Termino:</label>
                <input type="date" name="endPrevision" placeholder="Previsão de Termino" value="{{ old('endPrevision') }}">
                @error('endPrevision')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="status">Localização:</label>
                <input name="status" type="text" placeholder="Localização" value="{{ old('status') }}">
                @error('status')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="quantitySold">Quantidade Vendida:</label>
                <input name="quantitySold" type="number" placeholder="Quantidade Vendida" value="{{ old('quantitySold') }}">
                @error('quantitySold')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="quantityDead">Quantidade Morta:</label>
                <input name="quantityDead" type="number" placeholder="Quantidade Morta" value="{{ old('quantityDead') }}">
                @error('quantityDead')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="observation">Observação:</label>
                <input name="observation" type="text" placeholder="Observação" value="{{ old('observation') }}">
                @error('observation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <span>Esse botão só poderá ser clicado por usuário logados</span>
            <button type="submit">Manda!</button>
        </form> --}}
@endsection
    