<?php

namespace App\Http\Controllers;


use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index()
    {

        // carrega notas do usuário
        $id = session('user.id');
        $user = User::find($id);
        $notes = $user->notes()->whereNull('deleted_at')->get();


        // mostra a home
        return view('home', ['notes' => $notes]);
    }


    public function newNote()
    {
        return view('newNote');
    }

    public function newNoteSubmit(Request $request)
    {

        $request->validate(
            [
                'text_title' => "required|min:3|max:200",
                'text_note' => 'required|min:3|max:3000'
            ],

            //erro message 
            [
                'text_title' => 'O título é obrigatório',
                'text_note' => 'A nota é obrigatória',
                'text_title.min' => 'O título deve ter no mínimo :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres',
                'text_title.max' => 'O título deve ter no máximo :max caracteres',
                'text_note.min' => 'A nota deve ter no mínimo :min caracteres'
            ]
        );

        $id = session('user.id');
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->to('/');
    }
    public function editNote($id)
    {
        $id = Operations::decryptId($id);

        $note = Note::find($id);
        return view('edit_note', ['note' => $note]);

    }


    public function editNoteSubmit(Request $request)
    {
        $request->validate(
            [
                'text_title' => "required|min:3|max:200",
                'text_note' => 'required|min:3|max:3000'
            ],

            //erro message 
            [
                'text_title' => 'O título é obrigatório',
                'text_note' => 'A nota é obrigatória',
                'text_title.min' => 'O título deve ter no mínimo :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres',
                'text_title.max' => 'O título deve ter no máximo :max caracteres',
                'text_note.min' => 'A nota deve ter no mínimo :min caracteres'
            ]
        );

        if ($request->note_id == null) {
            return redirect()->route('home');
        }

        $id = Operations::decryptId($request->note_id);
        $note = Note::find($id);

        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->to('/');
    }

    public function deleteNote($id)
    {

        $id = Operations::decryptId($id);

        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);


    }

    public function deleteNoteConfirm($id)
    {

        $id = Operations::decryptId($id);

        $note = Note::find($id);

        // $note->delete();

        $note->forceDelete();

        // $note->save();

        return redirect()->to('/');

    }

}
