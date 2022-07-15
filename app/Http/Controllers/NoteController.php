<?php

namespace App\Http\Controllers;

use App\Http\Requests\note\StoreNoteRequest;
use App\Http\Requests\note\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Item;
use App\Models\Note;
use App\Models\NoteItem;
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
        $notes = Note::paginate($request->get('page_size', 20));
        $notes->load('customer', 'items');

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
        $selectedItems = collect($request->get('items'));
        $itemIds = $selectedItems->pluck('id');
        $queriedItems = Item::find($itemIds);

        $items = $queriedItems->map(function ($item, $index) use ($selectedItems) {
            $itemsQuantity = $selectedItems->get($index)['quantity'];

            return [
                'item_id' => $item->id,
                'quantity' => $itemsQuantity,
                'total' => $item->price * $itemsQuantity,
            ];
        });

        $total = $items->sum('total');
        $data = $request->except('items');
        $note = Note::create([...$data, 'total' => $total]);
        $note->items()->attach($items);
        $note->load('customer', 'items');

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
        $note->load('customer', 'items');

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
        $note = Note::find($id);
        $selectedItems = collect($request->get('items'));
        $itemIds = $selectedItems->pluck('id');
        $queriedItems = Item::find($itemIds);

        $items = $queriedItems->map(function ($item, $index) use ($selectedItems) {
            $itemsQuantity = $selectedItems->get($index)['quantity'];

            return [
                'item_id' => $item->id,
                'quantity' => $itemsQuantity,
                'total' => $item->price * $itemsQuantity,
            ];
        });

        $total = $items->sum('total');
        $data = $request->except('items');
        $note->update([...$data, 'total' => $total]);
        $note->items()->sync($items);
        $note->load('customer', 'items');

        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        Note::destroy($id);
    }
}
