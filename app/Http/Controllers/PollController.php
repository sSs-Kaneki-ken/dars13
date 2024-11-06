<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::orderBy('id', 'asc')->paginate(5);
        return view('pages.poll', ['models'=>$polls]);
    }

    public function create()
    {
        if (auth()->user()->role == 'admin') {
            return view('pages.create.poll-create');
        } else {
            return redirect('/login');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $request->validate([
                'title' => 'required|max:255',
                
            ]);
            $data = $request->all();
            // dd($data);
            Poll::create($data);
            return redirect('/poll')->with('success', 'Ma\'lumot qo\'shildi!');
        } else {
            return redirect('/login');
        }

    }

    public function update_poll(Poll $poll)
    {
        // dd($user);
        if (auth()->user()->role == 'admin') {
            return view('pages.update.poll-update', ['poll' => $poll]);
        } else {
            return redirect('/login');
        }

    }

    public function update(Request $request, Poll $poll)
    {
        if (auth()->user()->role == 'admin') {
            $request->validate([
                'title' => 'required|max:255',
            ]);
            $data = $request->all();
            // dd($university);
            $poll->update($data);
            return redirect('/poll')->with('warning', 'Ma\'lumot yangilandi!');
        } else {
            return redirect('/login');
        }

    }

    public function delete(Poll $poll)
    {
        // dd($user);
        if (auth()->user()->role == 'admin') {
            $poll->delete();
            return redirect('/poll')->with('danger', 'Ma\'lumot o\'chirildi!');
        } else {
            return redirect('/login');
        }

    }

    public function active(Request $request, Poll $active)
    {
        if (auth()->user()->role == 'admin') {
            $data = $request->all();
            // dd($data);
            $active->update($data);

            return redirect('/poll')->with('warning', 'Ma\'lumot yangilandi!');
        } else {
            return redirect('/login');
        }



    }

    public function search(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $models = Poll::where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(5);

            return view('pages.poll', ['models' => $models]);
        } else {
            return redirect('/login');
        }


    }
}
