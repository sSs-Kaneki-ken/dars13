<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeOrDislike extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'value',
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
