<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongArrangement extends Model
{
    protected $with = ['arrangement', 'tuning'];
    protected $hidden = ['created_at', 'updated_at'];

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
