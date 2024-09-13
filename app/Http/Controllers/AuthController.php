<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        //check if user exists
        $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'Username ou Password errado!');
        }

        //check password is correct
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError', 'Username ou Password errado!');
        }

        // update lastlogin
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //login user
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        //redirect to home
        return redirect()->to('/');
    }

    public function logout()
    {
        // logout from session
        session()->forget('user');
        return redirect()->to('/login');
    }
}
