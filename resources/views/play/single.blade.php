@extends('layouts.app')

@section('title', "$audio->audio_title | config('app.name')")

@section('content')

	<div class="row">
		<div class="col-md-8 offset-2">
            @if (session('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
			<h1>{{ $audio['audio_title'] }}</h1>
			<audio controls autoplay src="{{ url('audio/'.$audio['audio_title'].'.mp3') }}" type="audio/mp3"></audio>
			{{$audio}}
		</div>
	</div>

@endsection