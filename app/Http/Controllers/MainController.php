<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

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

    public function editNote($id)
    {
        $id = $this->decrypt($id);
    }

    public function deleteNote($id)
    {
        $id = $this->decrypt($id);
    }

    //function decrypt
    private function decrypt($id)
    {
        //check decrypt id
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
        return $id;
    }
}
