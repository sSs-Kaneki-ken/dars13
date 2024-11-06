<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $categories = Category::orderBy('id', 'asc')->paginate(5);
            return view('pages.category', ['models' => $categories]);
        } else {
            return redirect('/login');
        }

    }
    public function create()
    {
        if (auth()->user()->role == 'admin') {
            return view('pages.create.category-create');
        } else {
            return redirect('/login');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $request->validate([
                'name' => 'required|max:255',
                'tr' => 'required|max:255',
            ]);
            $data = $request->all();
            // dd($data);
            Category::create($data);
            return redirect('/category')->with('success', 'Ma\'lumot qo\'shildi!');
        } else {
            return redirect('/login');
        }

    }

    public function update_category(Category $category)
    {
        // dd($user);
        if (auth()->user()->role == 'admin') {
            return view('pages.update.category-update', ['category' => $category]);
        } else {
            return redirect('/login');
        }

    }

    public function update(Request $request, Category $category)
    {
        if (auth()->user()->role == 'admin') {
            $request->validate([
                'name' => 'required|max:255',
                'tr' => 'required|max:255',
            ]);
            $data = $request->all();
            // dd($university);
            $category->update($data);
            return redirect('/category')->with('warning', 'Ma\'lumot yangilandi!');
        } else {
            return redirect('/login');
        }

    }

    public function delete(Category $category)
    {
        // dd($user);
        if (auth()->user()->role == 'admin') {
            $category->delete();
            return redirect('/category')->with('danger', 'Ma\'lumot o\'chirildi!');
        } else {
            return redirect('/login');
        }

    }

    public function active(Request $request, Category $active)
    {
        if (auth()->user()->role == 'admin') {
            $data = $request->all();
            // dd($data);
            $active->update($data);

            return redirect('/category')->with('warning', 'Ma\'lumot yangilandi!');
        } else {
            return redirect('/login');
        }



    }

    public function search(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $models = Category::where('name', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(5);

            return view('pages.category', ['models' => $models]);
        } else {
            return redirect('/login');
        }


    }
}
