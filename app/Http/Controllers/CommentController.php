<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        Comment::create($data);
        return back();
    }
}
