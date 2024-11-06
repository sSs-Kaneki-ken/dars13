<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\LikeOrDislike;
use App\Models\Poll;
use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\View;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('tr', 'asc')->get();
        $posts = Post::orderBy('id', 'desc')->paginate(8);

        return view('pages.index', ['models' => $categories, 'posts' => $posts]);
    }

    public function batafsil(Request $request, Post $post)
    {
        $categories = Category::orderBy('tr', 'asc')->get();
        $posts = Post::orderBy('id', 'asc')->get();
        $likeordislike = null;
        if (auth()->check()) {
            $likeordislike = LikeOrDislike::where('user_id', auth()->user()->id)->where('post_id', $post->id)->first();

        }
        $ip = $request->ip();
        $post_id = $post->id;
        $date = date('Y-m-d H:i:s');
        $view = View::where('user_ip', $ip)->where('post_id', $post_id)->first();

        if (!$view || $view->updated_at->diffInMinutes($date) >= 1) {
            if (!$view) {
                View::create([
                    'user_ip' => $ip,
                    'post_id' => $post_id,
                ]);

            } else {
                $view->updated_at = $date;
                $view->save();
            }

            $post->increment('view');
        }
        return view('pages.batafsil', ['models' => $categories, 'post' => $post, 'likeordislike' => $likeordislike]);
    }
    public function search(Request $request)
    {
        $categories = Category::orderBy('tr', 'asc')->get();

        $posts = Post::where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(5);

        return view('pages.index', ['posts' => $posts, 'models' => $categories]);
    }


    public function poll_index()
    {
        $categories = Category::orderBy('tr', 'asc')->get();
        $polls = Poll::orderBy('id', 'desc')->paginate(5);
        $answers = Answer::all();
        
        return view('pages.poll_Index', ['models' => $categories, 'polls' => $polls, 'answers' => $answers]);
    }
}
