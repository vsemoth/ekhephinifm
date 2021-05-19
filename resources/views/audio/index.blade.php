@extends('layouts.app')

@section('title', 'Audio Files | ' . config('app.name'))

@section('content')

	<div class="row">
		<div class="container">
			<h2>Audio Files <a href="{{ route('audiofiles.create') }}" class="btn btn-primary btn-sm" style="float: right;">New</a></h2>
			<table class="table">
				<thead>
					<tr>
						<td>Show:</td>
						<td>Presenter:</td>
						<td>Audio:</td>
						<td>Function:</td>
					</tr>
				</thead>
				<tbody>
					@foreach($shows as $show)
					@foreach($show->audio as $audio)
					<tr>
						<td>{{ $show->show_title }}</td>
						<td>{{ $show->presenter->username }}</td>
						@if($audio->show_id == $show->id)
						<!-- onclik 'play' event added -->
						<td><a onclick="play()" href="{{ route('audiofiles.show',$audio->id) }}">{{ $audio->audio_slug }}</a></td>
						<td>
							<form action="{{ route('audiofiles.destroy',$audio->id) }}" method="post">
								@csrf
								<input type="submit" name="delete" value="DELETE" class="btn btn-danger btn-sm">
								@method('DELETE')
							</form>
						</td>
						@endif
					</tr>
					@endforeach
					@endforeach
				</tbody>
			</table>
			<ul>
					@foreach($shows as $show)
					@foreach($show->audio as $audio)
				<li>{{ $show->presenter }}</li>
				<li>{{ $audio }}</li>
				<hr><br>
					@endforeach
					@endforeach
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		/*add script (function) to autoplay selected audio*/
	</script>

@endsection