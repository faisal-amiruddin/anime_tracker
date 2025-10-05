<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = ['season_id', 'title', 'genre', 'poster', 'last_episode'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
