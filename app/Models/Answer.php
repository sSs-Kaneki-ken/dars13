<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'user_ip',
        'choice_id',
        'poll_id',
    ];

    public function choices()
    {
        return $this->belongsTo(Choice::class, 'choice_id');
    }
    public function polls()
    {
        return $this->belongsTo(Poll::class, 'poll_id');
    }
}
