<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $hidden = ['artist_id', 'album_id', 'pack_id'];
    protected $with = ['artist', 'album', 'pack'];
    protected $appends = ['artist_name', 'album_name', 'pack_name'];

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

    public function getArtistNameAttribute()
    {
        return $this->artist->name;
    }

    public function getAlbumNameAttribute()
    {
        return $this->album->name;
    }

    public function getPackNameAttribute()
    {
        return $this->pack->name ?? 'N/A';
    }
}
