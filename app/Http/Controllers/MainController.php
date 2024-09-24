<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
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
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        echo 'I´m creating new note!';
    }

    public function editNote($id)
    {
        // $id = $this->decryptId($id);
        $id = Operations::decryptId($id);
    }

    public function deleteNote($id)
    {
        // $id = $this->decryptId($id);
        $id = Operations::decryptId($id);
    }
}
