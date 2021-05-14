@extends('layouts.app')

@section('title', "$audio->audio_title | config('app.name')")

@section('content')

	<div class="row">
		<div class="col-md-8 offset-2">
			<h1>{{ $audio['audio_title'] }}</h1>
			<audio controls autoplay src="{{ url('audio/'.$audio['audio_title'].'.mp3') }}" type="audio/mp3"></audio>
			{{$audio}}
		</div>
	</div>

@endsection