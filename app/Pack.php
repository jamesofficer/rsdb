<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $dates = ['date'];
    protected $hidden = ['created_at', 'updated_at'];

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('j M Y');
    }
}
