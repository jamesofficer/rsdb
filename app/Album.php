<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $appends = ['year'];

    public function artist()
    {
        return $this->belongsToMany(Artist::class);
    }
}
