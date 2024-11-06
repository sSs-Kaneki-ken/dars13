<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
        'poll_id',
        'title'
    ];

    public function polls()
    {
        return $this->belongsTo(Poll::class, 'poll_id');
    }
    public function answers()
    {
        return $this->belongsTo(Answer::class, 'choice_id');
    }
}
