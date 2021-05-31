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
							<td>
								<form action="{{ route('userprofiles.update',$audio->show->presenter->profile->id) }}" method="post">
									@csrf
									<input type="hidden" name="audio_id" value="{{ $audio->id }}">
									<input type="hidden" name="audio_slug" value="{{ $audio->audio_slug }}">
									<input type="submit" class="btn btn-primary btn-block" value="{{ $audio->audio_title }}">
									@method('PUT')
								</form>
							</td>
							<td>{{ $audio->show->presenter->id }}</td>
							<td>{{ $audio->audio_slug }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>

@endsection