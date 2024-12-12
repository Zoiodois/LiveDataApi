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
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password']
        ])){

            $token = $request->user()->createToken('teste');
            return( $token);
        }

        return ('seu burro');


    }
}
