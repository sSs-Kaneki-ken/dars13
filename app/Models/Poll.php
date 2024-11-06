<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'title',
        'is_active'
    ];

    public function choices()
    {
        return $this->hasMany(Choice::class, 'poll_id');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class, 'poll_id');
    }
}
