@extends('layouts.app')

@section('title', config('app.name'))

@section('content')

	<div class="row">
		<div class="container">
			<div class="col-md-8 offset-2">
				
				<h1>All Audio</h1>
				<table class="table">
					<thead>
						<tr>
							<td>Show:</td>
							<td>Presenter:</td>
							<td>Audio Title:</td>
						</tr>
					</thead>
					<tbody>
						@foreach($multipleaudio as $audio)
						<tr>
							<td>{{ $audio->show->show_title }}</td>
							<td>{{ $audio->show->presenter->username }}</td>
							<td><a class="btn btn-primary w-100" href="{{ route('play.single', $audio->audio_slug) }}">{{ $audio->audio_title }}</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>

@endsection