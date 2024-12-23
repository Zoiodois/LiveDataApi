@extends('master')

@section('content')
    

<div>
    
    <form action="/login" method="POST">
        @csrf
        <input name="namelogin" type="text" placeholder="name">
        <input name="emaillogin" type="email" placeholder="email">
        <input name="passwordlogin" type="password" placeholder="password">
        <button>Log In</button>
        
    </form>
</div>
@endsection