@extends('layouts.app')

@section('title', 'Show Records | ' . config('app.name', 'Ekhephini FM - Izwi Lenqubela'))

@section('content')

    <div class="row">
        <div class="container">
            <div class="col-md-8">
                <div class="offset-2">
                    <h2>Shows Index: <a style="float: right;" class="btn btn-primary btn-sm" href="{{ route('shows.create') }}">new</a></h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Show Title:</td>
                                <td>Presenter:</td>
                                <td>Show Audio:</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($shows as $show)
                        <tr>
                            @if($show->presenter_id == $show->presenter->id)
                            <td>{{ $show->show_title }}</td>
                            <td>{{ $show->presenter['username'] }}</td>
                            <td><a href="{{ route('shows.show',$show->id) }}">{{ $show->show_title }} Audio</a></td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="well">
                    <h2>Shortcut</h2>
                    <p>Content</p>
                </div>
            </div>
        </div>
    </div>

@endsection