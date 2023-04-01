<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notes = Note::get();
        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;

        if($note->save())
            return response()->json($note);
        else
            return response()->json(['message' => 'Failed to save note, please try again.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $note = Note::find($id);
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $note = Note::find($id);

        $note->title = $request->title;
        $note->content = $request->content;

        if($note->save())
            return response()->json($note);
        else
            return response()->json(['message' => 'Failed to update note, please try again.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $note = Note::find($id);

        if($note->delete())
            return response()->json(['message' => 'Note successfully deleted.']);
        else
            return response()->json(['message' => 'Failed to delete note, please try again.']);
    }

    //
    public function search(Request $request){
        $notes = Note::where('title', 'like', '%'.$request->title.'%')->get();
        return response()->json($notes);
    }
}
