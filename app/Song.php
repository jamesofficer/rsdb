<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $hidden = ['artist_id', 'album_id', 'pack_id'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }
}
