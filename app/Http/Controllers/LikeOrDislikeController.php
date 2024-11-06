<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LikeOrDislike;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeOrDislikeController extends Controller
{
    public function like(Request $request)
    {
        
        $data = $request->all();
        $existingLike = LikeOrDislike::where('user_id', $request->user_id)
            ->where('post_id', $request->post_id)
            ->first();

        if ($existingLike && $existingLike->value == 1) {

            $existingLike->delete();

            $post = Post::find($request->post_id);
            $post->like -= 1;
            $post->save();
        } else {
            if ($existingLike) {

                $existingLike->update(['value' => 1]);
                $post = Post::find($request->post_id);
                $post->dislike -= 1;
                $post->save();
            } else {
                LikeOrDislike::create($data);
            }

            $post = Post::find($request->post_id);
            $post->like += 1;
            $post->save();
        }

        return redirect()->back();
    }



    public function dislike(Request $request)
    {
        $data = $request->all();
        $existingDisLike = LikeOrDislike::where('user_id', $request->user_id)
            ->where('post_id', $request->post_id)
            ->first();

        if ($existingDisLike && $existingDisLike->value == 2) {

            $existingDisLike->delete();

            $post = Post::find($request->post_id);
            $post->dislike -= 1;
            $post->save();
        } else {
            if ($existingDisLike) {

                $existingDisLike->update(['value' => 2]);
                $post = Post::find($request->post_id);
                $post->like -= 1;
                $post->save();
            } else {
                LikeOrDislike::create($data);
            }

            $post = Post::find($request->post_id);
            $post->dislike += 1;
            $post->save();
        }

        return redirect()->back();
    }
}
