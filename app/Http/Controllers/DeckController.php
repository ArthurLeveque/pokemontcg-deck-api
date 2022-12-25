<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Deck::with('cards')->get();
        
        return $data->map(function ($i) {
            $i->cards_count = $i->cards->sum('quantity');
            return $i;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $deck = Deck::create($data);

        return response()->json($deck->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Deck::with('cards')->findOrFail($id);

        $data->cards_count = $data->cards->sum('quantity');

        return response()->json($data);
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
        $deck = Deck::findOrFail($id);

        
        $data = $request->validate([
            'name' => 'max:100',
            'image' => 'nullable|string'
        ]);

        return response()->json($deck->update($data));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deck = Deck::findOrFail($id);

        
        Card::where('deck_id', $id)->delete();

        return response()->json($deck->delete());
        
    }
}
