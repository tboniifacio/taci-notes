<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login() {
       return view('login');
    }
 
    public function loginSubmit(Request $request) {

        // form validation 

    $request->validate(
       [
        'text_username' => "required|email",
        'text_password' => 'required|min:6|max:16'
       ],

       //erro message 
       [
        'text_username.required' => 'O username é obrigatório',
        'text_username.email' => 'Digite um email válido',
        'text_password.required' => 'A senha é obrigatória',
        'text_password.min' => 'A senha deve ter no mínimo :min digitos',
        'text_password.max' => 'A senha deve ter no máximo :max digitos',
       ]
    );
         //get user input
    $username = $request->input('text_username');
    $password = $request->input('text_password');


    $user = User::where('username', $username)
                ->whereNull('deleted_at')
                ->first();

                 if(!$user){
        return redirect()
        ->back()
        ->withInput()
        ->with('loginError', 'Username ou senha não existem');
    }

                     if(!password_verify($password, $user->password)){
        return redirect()
        ->back()
        ->withInput()
        ->with('loginError', 'Username ou senha não existem');
    }

    $user->last_login = date('Y-m-d H:i:s');
    $user->save();

    session(
        [
            'user' => [
                'id' => $user->id,
                'username'=> $user->username
            ]
        ]
    );
        return redirect()->to('/');

    }

   public function logout() {
        session()->forget('user');
        return redirect()->to('/login');
    }
}
