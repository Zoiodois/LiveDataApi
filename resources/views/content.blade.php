<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenhouse Control Pannel</title>
    @vite( ['resources/css/app.css', 
    'resources/scss/style.scss',
    'resources/js/app.js'])
  
</head>


<body>

    @include('partials/header')

    <div>

     
    <div class="data">

        <div class="left-column">
            <h1>Clima Atual</h1>
            
            <!--Dev a new controller to make the API call and Retrive the values, Maybe an asyncronhos request with js -->
            
            <!-- Example of Sunny Condition -->
            <div class="info-item bg-sun">
                <p><strong>Temperatura:</strong> {{ $weather['temperatura'] }} °C</p>
            </div>
            
            <!-- Example of Rainy Condition -->
            <div class="info-item bg-rain">
                <p><strong>Umidade do Ar:</strong> {{ $weather['umidade_relativa'] }} %</p>
            </div>
            
        <!-- Example of Cold Condition -->
        <div class="info-item bg-cold">
            <p><strong>Sensação Térm: </strong>{{ $weather['sensacao'] }} °C</p>
        </div>
        
        <!-- Probability of Rain with Color-Coded Text -->
        <div class="info-item bg-rain">
            <p><strong>Prob. de Chuva:</strong>
                <span class="normal-rain">40%</span>
            </p>
        </div>
        
        <!-- Evapotranspiration Pressure with Color-Coded Text -->
        <div class="info-item bg-sun">
            <p><strong>Pressão de Evapotranspiração:</strong>
                <span class="high-pressure">4 kPa</span>
            </p>
        </div>
    </div>
    
    <div class="column center-column">
        <h1>Painel de Campo</h1>
        <div class="details-info">
            <h2>Ultimas Irrigações:</h2>
            <table class="details">
                
                
                <tr>
                    <th>Alfaces</th>
                    <td>{{  $tranformedEpochs['lastIr1Epoch']['data'] }}</td>
                    <td>{{  $tranformedEpochs['lastIr1Epoch']['time'] }}</td>
                    
                </tr>
                <tr>
                    <th>Canteiro 1</th>
                    
                    <td>{{  $tranformedEpochs['lastIr2Epoch']['data'] }}</td>
                    <td>{{  $tranformedEpochs['lastIr2Epoch']['time'] }}</td>
                </tr>
                <tr>
                    <th>Canteiro 2</th>
                    <td>{{  $tranformedEpochs['lastIr3Epoch']['data'] }}</td>
                    <td>{{  $tranformedEpochs['lastIr3Epoch']['time'] }}</td>
                </tr>
                <tr>
                    <th>Canteiro 3</th>
                    <td>{{  $tranformedEpochs['lastIr4Epoch']['data'] }}</td>
                    <td>{{  $tranformedEpochs['lastIr4Epoch']['time'] }}</td>
                </tr>
                <tr>
                    <th>Canteiro 4</th>
                    <td>{{  $tranformedEpochs['lastIr5Epoch']['data'] }}</td>
                    <td>{{  $tranformedEpochs['lastIr5Epoch']['time'] }}</td>
                </tr>
            </table>
        </div>
        
        <div class="estufa-details">
            <h2>Dados Gerais Estufa:</h2>
            <table class="details">
                
                
                <tr>
                    <th>Fim do último Ciclo: </th>
                    <td>Data: {{  $tranformedEpochs['lastIr5Epoch']['data'] }}, Hora: {{  $tranformedEpochs['lastIr5Epoch']['time'] }}</td>
                    
                </tr>
                <tr>
                    <th>Umidade Atual:</th>
                    <td>{{  $liveData['UrGHouse']}}</td>
                    
                </tr>
                <tr>
                    <th>Tempo de Estufa(Passar esse valor do Modulo):</th>
                    <td>30 min</td>
                </tr>
                <tr>
                    <th>Umidade Desejada</th>
                    <td>
                        Criar esse Controller - ConfigController
                    </td>
                </tr>
                <tr>
                    <th>Fim deste Ciclo: (Espaço Vago) </th>
                    <td>Data: {{  $tranformedEpochs['lastIr5Epoch']['data'] }}, Hora: {{  $tranformedEpochs['lastIr5Epoch']['time'] }}</td>
                </tr>
            </table>
            
            
            
        </div>
    </div>
    
    <div class="right-column">
        <h1>Estoque de Plantas</h1>
        
        
        @foreach ($stock as $data)
        <button class="collapsible">{{ $data['displayName'] }} - {{ $data['status'] }}</button>
        <div class="content">
            <p><strong>Data de Plantio:</strong>{{ $data['plantDate'] }} </p>
            <p><strong>Quantidade:</strong>{{ $data['quantity'] }}</p>
            <p><strong>Cor indicativa:</strong> {{ $data['idColor'] }}</p>
            <p><strong>Dias até transplante:</strong>{{ $data['endPrevision'] }}</p>
            <p><strong>Vendidas:</strong> {{ $data['quantitySold'] }}</p>
            <p><strong>Mortas:</strong> {{ $data['quantityDead'] }}</p>
            <p><a href="/editProdForm/{{ $data->id }}"
                style="border: solid 1px black; margin: 5px; padding: 3px; background-color: rgb(84, 104, 190) ">Editar</a>
            </p>
            
        </div>
        @endforeach
        
        <form action="/getProdForm" method="GET">
            
            <button type="submit">Incluir nova Produção via Form</button>
        </form>
        
        <div>
            
            <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="csv_file">Importas novas Produção via CSV:</label>
                <input type="file" name="csv_file" id="csv_file" required>
                <button type="submit">Enviar CSV</button>
            </form>
            
        </div>
        
        
        
        
        {{-- <div>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="name">
                <input name="email" type="email" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button>Register</button>
                
            </form>
        </div>
        
        
        <div>
            <form action="/login" method="POST">
                @csrf
                <input name="namelogin" type="text" placeholder="name">
                <input name="emaillogin" type="email" placeholder="email">
                <input name="passwordlogin" type="password" placeholder="password">
                <button>Log In</button>
                
            </form>
        </div>
        
        
        
        
        
        @endauth --}}
    </div>

    </div>

    @include('partials/footer')
     
        
        
        <script>
            // JavaScript para funcionalidade de colapsar
            const collapsibles = document.querySelectorAll(".collapsible");
            
            collapsibles.forEach(button => {
                button.addEventListener("click", function() {
                    this.classList.toggle("active");
                    
                    const content = this.nextElementSibling;
                    if (content.style.display === "block") {
                        content.style.display = "none";
                    } else {
                        content.style.display = "block";
                    }
                });
            });
            </script>

</body>

</html>
