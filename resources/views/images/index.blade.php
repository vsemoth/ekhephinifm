@extends('layouts.app')

@section('title', config('app.name', 'Ekhephini FM - Izwi Lenqubela') . ' | Profile Pictures')

@section('content')

    <div class="container">
        <h2>Profile Pictures <a class="btn btn-primary" style="float: right;" href="{{ route('profiles.index') }}">View Profile</a></h2>
        <ol>
            <li>
            @foreach(Auth::user()->profile->image as $image)
                <a href=""><img src="{{ $image->image_path }}" alt="$image->image">
                    @foreach(Auth::user()->profile as $profile)
                        @if($profile == Auth::user()->id)
                            {{ $profile }}
                        @endif
                    @endforeach
                </a>
                <hr>
            @endforeach
            </li>
        </ol>
    </div>

@endsection