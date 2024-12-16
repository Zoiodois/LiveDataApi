<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request){

        return response()->json(['message' => 'You are connected'], 200);
           

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
