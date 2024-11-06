<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'text',
        'image',
        'like',
        'dislike',
        'view'
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function LikeOrDislike()
    {
        return $this->hasMany(LikeOrDislike::class, 'post_id');
    }
    public function views()
    {
        return $this->hasMany(View::class, 'post_id');
    }
}
