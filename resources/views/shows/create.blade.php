@extends('layouts.app')

@section('title', 'Upload Audio | ' . config('app.name', 'Ekhephini FM - Izwi Lenqubela'))

@section('content')

<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-8">
                <h2>Create Show <a href="{{ route('shows.index') }}" class="btn btn-info" style="float: right;">View Shows</a></h2>
                @if( session('success') )
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('shows.store') }}" method="post">
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

                    <label for="category" class="mt-5">Choose a Category:</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <optgroup label="Category">
                                <option value="#">select</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </optgroup>
                        </select>

                    <input type="hidden" name="listen_status" value="0">
                    <label for="show_title" class="mt-5">Show Title:</label>
                    <input type="text" name="show_title" class="form-control" placeholder="Enter Show Title...">
                    <button class="btn btn-primary btn-block mt-4">Create Show</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection