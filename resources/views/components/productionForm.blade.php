<div class="mx-40">

    <form action="{{$action}}" method="{{$method}}" >
        @csrf
    
      {{ $slot }}
    
       </form>

</div>