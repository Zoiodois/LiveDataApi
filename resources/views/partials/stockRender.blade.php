<div x-data="{ 
    stock: @js($stock),
    open: {},
    errors:[],
    currentData: {},
    toggleOpen(id) {
        const currentState = this.open[id];
        Object.keys(this.open).forEach(key => this.open[key] = false);
        this.open[id] = !currentState;
    },
    editing : false,
    {{-- currentData: null,  --}}
    editData(data) {
        this.editing = true;
        this.currentData = { ...data }; // Copia os dados para evitar edições diretas
        },
    async saveData(updateData) {
        {{-- console.log(JSON.stringify(updateData)); --}}

        const token = document.querySelector('#__token').getAttribute('content');
        const response = await
        fetch('/public/updateForm', {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN' : token,
                'Content-Type': 'application/json' },
            body: JSON.stringify(updateData),
        })
        
        let data = await response.json();
        this.errors = data.errors;
        this.editing = false; // Fecha o modal
        if (response.ok) {
            this.updateStock(data)
        }


    },
    async updateStock(updatedData) {
        try {
            const index = this.stock.findIndex(item => item.id === updatedData.success.id);
            // Atualiza o elemento no array
            if (index !== -1) {
                this.stock.splice(index, 1, updatedData.success);
            } else {
                console.warn('Elemento não encontrado no array de estoque.');
            }
        } catch (error) {
            console.error('Erro ao atualizar o estoque:', error);
        }
    },
 
   
    }">
    <template x-for="data in stock" :key="data.id">
        <div>
            <!-- Botão colapsável -->
            <button 
                x-on:click="toggleOpen(data.id)" 
                class="collapsible"
                x-text="`${data.displayName} - ${data.status}`">
            </button>
            
            <!-- Conteúdo colapsável -->
            <div x-show="open[data.id]" class="content">
                <table class="table-fixed border-separate border-spacing-2 border border-slate-400">
                    <thead>
                        <tr>
                            <th class="border border-slate-300 ">Batch ID:</th>
                            <th class="border border-slate-300 " >Matriz Id:</th>
                            <th class="border border-slate-300 ">Seed Bank Id:</th>
                        </tr>      
                    </thead>
                    <tbody>
                        <tr>
                            <td x-text="data.batchId" class="border border-slate-300 " ></td>
                            <td x-text="data.matrixId" class="border border-slate-300" ></td>
                            <td x-text="data.seedBankId" class="border border-slate-300"></td>
                        </tr>
                    </tbody>
                </table>

                <p><strong>Data de Plantio:</strong> <span x-text="data.plantDate"></span></p>
                <p><strong>Quantidade:</strong> <span x-text="data.quantity"></span></p>
                <p><strong>Cor indicativa:</strong> <span x-text="data.idColor"></span></p>
                <p><strong>Dias até transplante:</strong> <span x-text="data.endPrevision"></span></p>
                <p><strong>Vendidas:</strong> <span x-text="data.quantitySold"></span></p>
                <p><strong>Mortas:</strong> <span x-text="data.quantityDead"></span></p>
                <p><strong>Observações:</strong> <span x-text="data.observation"></span></p>
                
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

    <!-- Modal de Edição -->
     <div x-show="editing" class="flex "style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); display: none;" @click.away="editing = false">
        <div  class="block" style="background: white; padding: 20px; margin: auto; width: 50%; border-radius: 10px;">
            <h2 x-text="'Editar:  ' + currentData.displayName + '  Batch ID: ' + currentData.batchId"></h2>
            

            <x-forms.input-text type="hidden" name="batchId"  x-model="currentData.batchId"/>
            <x-forms.input-text type="hidden" name="matrixId"  x-model="currentData.matrixId"/>
            <x-forms.input-text type="hidden" name="seedBankId"  x-model="currentData.seedBankId"/>         
            <x-forms.input-text type="text" name="status"  x-model="currentData.status"/>
            <x-forms.input-text type="text" name="observation" label="Observação" x-model="currentData.observation"/>
            <x-forms.input-text type="date" name="plantDate" label="Data de Plantio" x-model="currentData.plantDate"/>
            <x-forms.input-text type="text" name="idColor" label="Cor indicativa" x-model="currentData.idColor" />
            <x-forms.input-text type="number" name="quantity" label="Quandtidade" x-model="currentData.quantity" />
            <x-forms.input-text type="date" name="endPrevision" label="Dias até transplante" x-model="currentData.endPrevision" />
            <x-forms.input-text type="number" name="quantitySold" label="Vendidas" x-model="currentData.quantitySold" />
            <x-forms.input-text type="number" name="quantityDead" label="Mortas" x-model="currentData.quantityDead" />

            <div style="margin-top: 20px;">
                <button 
                    @click="saveData(currentData)" 
                    style="background: green; color: white; padding: 10px; border: none; border-radius: 5px;">
                    Salvar
                </button>
                <button 
                    @click="editing = false" 
                    style="background: red; color: white; padding: 10px; border: none; border-radius: 5px;">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>


