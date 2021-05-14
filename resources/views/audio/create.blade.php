@extends('layouts.app')

@section('title', 'Add Audio | ' . config('app.name', 'Ekhephini FM'))

@section('content')

	<div class="row">
		<div class="container">
			<h2>Add Show Audio</h2>
			<form enctype="multipart/form-data" action="{{ route('audiofiles.store') }}" method="post">
				@csrf
                <label for="user" class="mt-5">Choose a Presenter:</label>
                    <select name="presenter_id" id="user" class="form-control">
                        <optgroup label="Presenter">
                            <option value="#">select</option>
                            @foreach($users as $user)
                                @if($user->profile->presenter)
	                                @if($user->profile->presenter['presenter_status'] == 1)
	                                <option value="{{ $user->profile->presenter['id'] }}">{{ $user->profile['username'] }}</option>
	                                @endif
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                    
                <label for="show_id" class="mt-5">Choose a Show:</label>
                    <select name="show_id" id="show_id" class="form-control">
                        <optgroup label="Show ID">
                            <option value="#">select</option>
                    		@foreach($shows as $show)
	                            <option value="{{ $show->id }}">{{ $show->show_title }}</option>
                            @endforeach
                        </optgroup>
                    </select>

                <!-- <label for="audio_slug" class="mt-5">Slug:</label>
                <input type="text" name="audio_slug" class="form-control" placeholder="Input Slug" required="" minlength="5" maxlength="255"> -->

                <label for="audio_title" class="mt-5">Audio:</label>
                <input type="file" name="audio_title" class="form-control" multiple>

                <input type="submit" value="Upload Audio" class="btn btn-success btn-block mt-3">
			</form>
		</div>
	</div>

@endsection