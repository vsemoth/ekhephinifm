@extends('layouts.app')

@section('title', $audiofile['audio_title'] . config('app.name'))

@section('content')

	<div class="row">
		<div class="container">
			<dl>
				<dt>URL:</dt>
				<dt><a href="{{ url('play/'.$audiofile->audio_slug) }}">{{ url('play/'.$audiofile->audio_slug) }}</dt></a>
			</dl>

			<dl>
				<audio controls src="{{ url('audio/'.$audiofile['audio_slug']) }}" type="audio/mp3"></audio>
			</dl>			
		</div>
	</div>

@endsection