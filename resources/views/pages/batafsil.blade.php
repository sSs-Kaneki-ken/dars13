@extends('layouts.selecao')

@section('title', 'Batafsil')

@section('content')



<div class="row">
    <div class="col-8">
        <div style="display: inline-block;">
            <a href="/" class="btn btn-primary back" style="display: inline-block;">Orqaga</a>
            <p style="display: inline-block; margin-left: 10px;"><i class="fas fa-eye"></i> {{$post->view}}</p>
        </div>
        <img src="{{ asset($post->image) }}" class="center mt-2" alt="">
        <h1 class="center">{{ $post->title }}</h1>
        <h5 class="center">{{ $post->description }}</h5>
        <p class="center">{{ $post->text }}</p>
        <div class="d-flex justify-content-end">
            @if (auth()->check())
                @if ($likeordislike)
                    <form action="/like" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button type="submit" name="value" value="1"
                            class="btn {{ $likeordislike->value == 1 ? 'btn-primary' : 'btn-outline-primary' }} me-2">{{ $post->like }}
                            <i class="bi bi-hand-thumbs-up"></i></button>
                    </form>

                    <form action="/dislike" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button type="submit" name="value" value="2"
                            class="btn {{$likeordislike->value == 2 ? 'btn-primary' : 'btn-outline-primary' }}">{{ $post->dislike }}
                            <i class="bi bi-hand-thumbs-down"></i></button>
                    </form>
                @else
                    <form action="/like" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button type="submit" name="value" value="1" class="btn btn-outline-primary me-2">{{ $post->like }}
                            <i class="bi bi-hand-thumbs-up"></i></button>
                    </form>

                    <form action="/dislike" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button type="submit" name="value" value="2" class="btn btn-outline-primary">{{ $post->dislike }}
                            <i class="bi bi-hand-thumbs-down"></i></button>
                    </form>
                @endif



            @else
                <a href="/login" class="btn btn-outline-primary me-2">
                    {{ $post->like }} <i class="bi bi-hand-thumbs-up"></i>
                </a>

                <a href="/login" class="btn btn-outline-primary me-2">
                    {{ $post->dislike }} <i class="bi bi-hand-thumbs-down"></i>
                </a>
            @endif

        </div>
    </div>

    <div class="col-4">
        <h1>Comments</h1>
        @if (isset($post->comments))
            <ul>
                @foreach($post->comments as $comment)
                    <li>
                        <h5>{{ $comment->users->name }}</h5>
                        <p>{{ $comment->text }}</p>
                    </li>
                @endforeach
            </ul>
            @if (auth()->check())
                <form action="/createComment" method="POST">
                    @csrf
                    <div class="input-group col-12 mt-2">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="text" class="form-control" name="text" placeholder="Enter Comment">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            @endif

        @endif
    </div>
</div>
@endsection