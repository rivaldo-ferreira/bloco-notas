<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        //validation form
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16',
            ],
            [
                'text_username.required' => 'Username obrigatório!',
                'text_username.email' => 'Username deve ser um E-mail válido',
                'text_password.required' => 'Senha obrigatória',
                'text_password.min' => 'Senha com no mínimo de :min caracteres',
                'text_password.max' => 'Senha com no máximo de :max caracteres'

            ]
        );

        // echo 'login submit';
        $text_username = $request->input('text_username');

        $text_password = $request->input('text_password');

        try {
            DB::connection()->getPdo();
            echo 'Connection is ok!';
        } catch (\PDOException $e) {
            echo 'Connection failed ' . $e->getMessage();
        }

        echo 'fim!';
    }

    public function logout()
    {
        echo 'logout';
    }
}
