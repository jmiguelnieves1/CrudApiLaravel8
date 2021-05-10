<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    private function validateLogin(Request $request){
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]);
    }

    public function login(Request $request){
        //Validamos
        $this->validateLogin($request);

        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                //Creamos el token del usuario y el name es el dispositivo del que se coencta. Por ejemplo IphoneToken
                'token' => $request->user()->createToken($request->name)->plainTextToken,
                'message' => 'Success'
            ]);
        }else{
            return response()->json([
                'message' => 'No autorizado',
            ], 401);
        }
    }
}
