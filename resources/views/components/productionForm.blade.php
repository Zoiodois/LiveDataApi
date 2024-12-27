<div class="flex justify-center">

    <form action="{{$action}}" method="{{$method}}" >
        @csrf
    
      {{ $slot }}
    
       </form>

</div>