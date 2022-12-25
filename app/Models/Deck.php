<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    protected $hidden = ['updated_at', 'created_at'];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
