<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'text_username' => 'required',
                'text_password' => 'required',
            ]
        );

        // echo 'login submit';
        $text_username = $request->input('text_username');

        $text_password = $request->input('text_password');

        echo 'ok';
    }

    public function logout()
    {
        echo 'logout';
    }
}
