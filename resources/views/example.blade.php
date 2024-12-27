@extends('master')

@section('content')


<div x-data="{ 
    stock: @js($stock),
    open: false            
    }">
    <template x-for="data in stock.slice(0, 1)" :key="data.id">
        <div>
            <!-- Botão colapsável -->
            <button 
                x-on:click="open = !open" 
                class="collapsible"
                x-text="`${data.displayName} - ${data.status}`">
            </button>
            
            <!-- Conteúdo colapsável -->
            <div x-show="open" class="content">
                <p><strong>Data de Plantio:</strong> <span x-text="data.plantDate"></span></p>
                <p><strong>Quantidade:</strong> <span x-text="data.quantity"></span></p>
                <p><strong>Cor indicativa:</strong> <span x-text="data.idColor"></span></p>
                <p><strong>Dias até transplante:</strong> <span x-text="data.endPrevision"></span></p>
                <p><strong>Vendidas:</strong> <span x-text="data.quantitySold"></span></p>
                <p><strong>Mortas:</strong> <span x-text="data.quantityDead"></span></p>
                
                <!-- Botão de Edição -->
                <p>
                    <button 
                        @click="editData(data)" 
                        style="border: solid 1px black; margin: 5px; padding: 3px; background-color: rgb(84, 104, 190); color: white;">
                        Editar
                    </button>
                </p>
            </div>
        </div>
    </template>
</div>



@endsection