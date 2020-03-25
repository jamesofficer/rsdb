<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $dates = ['date'];

    public function getFormattedDateAttribute()
    {
        return $this->date->format('j M Y');
    }
}
