<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // show users
        $id = session('user.id');
        // $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();


        //home
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        echo "I'm creating a new note!";
    }
}
