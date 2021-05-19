@extends('layouts.app')

@section('title', 'Show Records | ' . config('app.name', 'Ekhephini FM - Izwi Lenqubela'))

@section('content')

    <div class="row">
        <div class="container">
            <div class="col-md-8">
                <div class="offset-2">
                    <h2>Shows Index: <a style="float: right;" class="btn btn-primary btn-sm" href="{{ route('shows.create') }}">new</a></h2>
                    <ul>
                        @foreach($show->audio as $audio)
                        <li><a class="btn btn-primary w-100 mt-5" href="{{ route('play.single', $audio->audio_slug) }}">{{ $audio->audio_title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection