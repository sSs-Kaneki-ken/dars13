<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $posts = Post::orderBy('id', 'asc')->paginate(5);
            return view('pages.post', ['models' => $posts]);
        } else {
            return redirect('/login');
        }

    }
    public function create()
    {
        if (auth()->user()->role == 'admin') {
            $categories = Category::all();
            $users = User::all();
            return view('pages.create.post-create', ['categories' => $categories, 'users' => $users]);
        } else {
            return redirect('/login');
        }

    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $request->validate([
                'title' => 'required|max:255',
                'text' => 'required',
                'description' => 'required',
                'image' => 'required|file|mimes:png,jpg,jpeg',
                'category_id' => 'required|exists:categories,id',

            ]);
            $data = $request->all();


            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
                $file->move('image_upload/', $filename);
                $data['image'] = 'image_upload/' . $filename;
            }

            Post::create($data);
            return redirect('/posts')->with('success', 'Ma\'lumot qo\'shildi!');
        } else {
            return redirect('/login');
        }


    }

    public function update_post(Post $post)
    {
        if (auth()->user()->role == 'admin') {
            // dd($user);
            $categories = Category::all();
            $users = User::all();
            return view('pages.update.post-update', ['post' => $post, 'categories' => $categories, 'users' => $users]);
        } else {
            return redirect('/login');
        }

    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->role == 'admin') {
            $request->validate([
                'title' => 'required|max:255',
                'text' => 'required',
                'image' => 'required|file|mimes:png,jpg,jpeg',
                'category_id' => 'required|exists:categories,id',
                'description' => 'required',

            ]);
            $data = $request->all();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
                $file->move('image_upload/', $filename);
                $data['image'] = 'image_upload/' . $filename;
            }
            // dd($university);
            $post->update($data);
            return redirect('/posts')->with('warning', 'Ma\'lumot yangilandi!');
        } else {
            return redirect('/login');
        }


    }

    public function delete(Post $post)
    {
        if (auth()->user()->role == 'admin') {
            $post->delete();
            return redirect('/posts')->with('danger', 'Ma\'lumot o\'chirildi!');
        } else {
            return redirect('/login');
        }

    }

    public function search(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $models = Post::where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(5);

            return view('pages.post', ['models' => $models]);
        } else {
            return redirect('/login');
        }


    }


    public function getPostsByCategory($category)
    {
        $posts = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('id', $category);
        })->paginate(8);

        $models = Category::all();

        return view('pages.index', compact('posts', 'models'));
    }
}
