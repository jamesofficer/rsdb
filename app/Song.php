<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $hidden = ['artist_id', 'album_id', 'pack_id'];
    protected $with = ['artist', 'album', 'pack', 'songArrangements'];
    protected $appends = ['artist_name', 'album_name', 'pack_name', 'average_difficulty'];

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

    public function songArrangements()
    {
        return $this->hasMany(SongArrangement::class);
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

    public function getAverageDifficultyAttribute()
    {
        $difficulties = [];

        foreach ($this->songArrangements as $songArrangement) {
            $difficulties[] = $songArrangement->difficulty;
        }

        return round(array_sum($difficulties) / count($difficulties) * 100);
    }
}
