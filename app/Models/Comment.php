<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'text',
        'user_id'
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
