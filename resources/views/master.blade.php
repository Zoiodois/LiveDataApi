
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenhouse Control Pannel</title>
    @vite( ['resources/css/app.css', 
    'resources/scss/style.scss',
    'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}" id="__token">
  
</head>
      {{-- <ul>
        <li class="py-6">Componentes a fazer: </li>
        <li class="py-6">Formulario Nova Produção: Check</li>
        <li>Formulario Editar Produção:</li>
        <li class="py-6">Formulario Login:</li>
        <li>eNTENDER COMO USAR O aLPINE NESSE BLADE SYSTEM:</li>
        <li>Incluir tailwind nos forms</li>
      </ul> --}}

<body>
    @include('partials/header')

    @yield('content')

    @include('partials/footer')

</body>

</html>