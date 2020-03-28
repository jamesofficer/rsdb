<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $hidden = ['artist_id', 'album_id', 'pack_id'];
    protected $with = ['artist', 'album', 'pack', 'songArrangements'];
    protected $appends = ['artist_name', 'album_name', 'pack_name', 'search_string', 'average_difficulty'];

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

    public function getSearchStringAttribute()
    {
        $string = $this->title . ' ' . $this->artist_name . ' ' . $this->album_name . ' ' . $this->pack_name;

        return strtolower(preg_replace('/[^a-z0-9]+/i', ' ', $string));
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
        return $this->pack->name ?? '';
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
