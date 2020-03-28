<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $dates = ['date'];
    protected $appends = ['year'];


    public function artist()
    {
        return $this->belongsToMany(Artist::class);
    }

    public function getYearAttribute()
    {
        return $this->date->format('Y');
    }
}
