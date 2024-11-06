@extends('layouts.selecao')

@section('title', 'index')

@section('content')

@foreach ($polls as $poll)

<div class="col-5">
    @if ($poll->is_active == 1)
        <div class="d-flex justify-content-between">
            <h1>{{ $poll->title }}</h1>
            <form action="/deleteAnswer" method="POST">
                @csrf
                @foreach($poll->answers as $answer)

                    <input type="hidden" name="id" value="{{ $answer->id }}">

                @endforeach
                
                <button type="submit" class="btn btn-danger">Ovozni bekor qilish</button>
            </form>
        </div>

        <form action="/answer" method="POST">
            @csrf
            <input type="hidden" name="poll_id" value="{{ $poll->id }}">

            @php
                $totalAnswers = $poll->answers->count();
            @endphp

            @foreach ($poll->choices as $choice)
                @php

                    $choiceAnswers = 0;

                    foreach ($answers as $answer) {
                        if ($choice->id == $answer->choice_id) {
                            $choiceAnswers++;
                        }
                    }

                    $percentage = $totalAnswers > 0 ? ($choiceAnswers / $totalAnswers) * 100 : 0;
                    
                    $disabled = false;
                    $selected = false;
                    foreach ($poll->answers as $answer) {
                        if ($answer->user_ip === request()->ip()) {
                            $disabled = true;
                            if ($answer->choice_id === $choice->id) {
                                $selected = true;
                            }
                        }
                    }
                @endphp

                <button type="submit" class="btn @if($selected) btn-primary selected @else btn-outline-primary @endif center2 mt-1" name="choice_id" value="{{ $choice->id }}" @if($disabled) disabled @endif>
                    {{ $choice->title }}<br> Ovozlar:{{ $choiceAnswers }} ({{ $percentage }}%)
                </button>

            @endforeach
        </form>

        <div class="d-flex justify-content-end">
            <p>Ovozlar: {{ $totalAnswers }} ta</p>
        </div>

    @endif

</div>

@endforeach

@endsection