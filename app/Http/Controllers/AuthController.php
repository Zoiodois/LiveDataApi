<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function showLoginPage(){
        return view('loginPage');
    }

    
    public function login(Request $request)  {
     
        $incomingFields = $request->validate([
            'namelogin'=>['required'],
            'passwordlogin' => ['required'],
        ]);

        if( auth()->attempt(['name'=>$incomingFields['namelogin'],'password'=>$incomingFields['passwordlogin']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout()  {
        auth()->logout();
        return redirect('/stock');
    }


    public function create_user(Request $request){

        $incomingFields = $request->validate([
            'name' =>[ 'required'], // Rule::unique('users', 'name')
            'email' => 'required',
            'password' => ''
        ]);

        $user = User::create($incomingFields);

        if(Auth::attempt([
            'name' => $incomingFields['name'],
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password']
        ])){

            return( 'Usuário criado com sucesso');
        }

        return ('Ops. Algo deu errado.');


    }

    public function create_token(Request $request){

        $incomingFields = $request->validate([
            'name' =>[ 'required'], // Rule::unique('users', 'name')
            'password' => [ 'required']
        ]);

        if(Auth::attempt([
            'name' => $incomingFields['name'],
            'password' => $incomingFields['password']
        ]))
        {
            $token = $request->user()->createToken('esp8266');
            return( $token);
        }
            
            
        return( 'Usuário não foi criado');
    }

}
