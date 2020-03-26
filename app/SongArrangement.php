<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongArrangement extends Model
{
    protected $with = ['arrangement', 'tuning'];

    public function arrangement()
    {
        return $this->belongsTo(Arrangement::class);
    }

    public function tuning()
    {
        return $this->belongsTo(Tuning::class);
    }

    public function getFormattedDifficultyAttribute()
    {
        return round($this->difficulty * 100);
    }
}
