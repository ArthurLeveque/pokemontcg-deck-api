<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['card_id', 'quantity', 'deck_id'];

    protected $hidden = ['updated_at', 'created_at', 'deck_id'];

    public function deck()
    {
        return $this->belongsTo(Deck::class);
    }
}
