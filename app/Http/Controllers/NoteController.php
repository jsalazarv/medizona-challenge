<?php

namespace App\Http\Controllers;

use App\Http\Requests\note\StoreNoteRequest;
use App\Http\Requests\note\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $notes = Note::paginate($request->get("'pageSize', 10"));

        return NoteResource::collection($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNoteRequest $request
     * @return NoteResource
     */
    public function store(StoreNoteRequest $request): NoteResource
    {
        $note = Note::create($request->all());

        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return NoteResource
     */
    public function show(int $id): NoteResource
    {
        $note = Note::find($id);

        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoteRequest $request
     * @param $id
     * @return NoteResource
     */
    public function update(UpdateNoteRequest $request, $id): NoteResource
    {
        $note = Note::findOrFail($id);
        $note->update($request->all());

        return new NoteResource($note);
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
    }
}
