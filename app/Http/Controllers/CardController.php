<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'card_id' => 'required',
            'deck_id' => 'required',
            'quantity' => 'required|integer'
        ]);

        return response()->json(Card::create($data));
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
        $card = Card::findOrFail($id);

        $data = $request->validate([
            'quantity' => 'required|integer'
        ]);

        return response()->json($card->update($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::findOrFail($id);
   
        if($card->quantity == 1) {
            return response()->json($card->delete());
        } else {
            $card->quantity = $card->quantity - 1;
            return response()->json($card->save());
        }
    }
}
