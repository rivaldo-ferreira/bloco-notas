<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class MainController extends Controller
{
    // AC 162 357 254 BR ---- correios

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
        //validate request
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'Título obrigatório!',
                'text_title.min' => 'Título com no mínimo de :min caracteres',
                'text_title.max' => 'Título com no máximo de :max caracteres',

                'text_note.required' => 'Nota obrigatória',
                'text_note.min' => 'Nota com no mínimo de :min caracteres',
                'text_note.max' => 'Nota com no máximo de :max caracteres'

            ]
        );

        //get user id
        $id = session('user.id');

        //create a new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        //redirect home
        return redirect()->route('home');
    }

    public function editNote($id)
    {
        // $id = $this->decryptId($id);
        $id = Operations::decryptId($id);

        //load note
        $note = Note::find($id);

        //show edit note view
        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request)
    {
        //validate request
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'Título obrigatório!',
                'text_title.min' => 'Título com no mínimo de :min caracteres',
                'text_title.max' => 'Título com no máximo de :max caracteres',

                'text_note.required' => 'Nota obrigatória',
                'text_note.min' => 'Nota com no mínimo de :min caracteres',
                'text_note.max' => 'Nota com no máximo de :max caracteres'

            ]
        );

        //check note_id exists
        if ($request->note_id == null) {
            return redirect()->route('home');
        }

        //decrypt note_id
        $id = Operations::decryptId($request->note_id);

        //load note
        $note = Note::find($id);

        //update note
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        //redirect to home
        return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        // $id = $this->decryptId($id);
        $id = Operations::decryptId($id);
    }
}
