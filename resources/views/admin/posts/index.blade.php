@extends('layouts.app')
                @if(!Auth::user())
                        <script>window.location = "/home";</script>
                @endif
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Post Index') }} <a href="{{ route('posts.create') }}" style="float: right;clear: both;" class="btn btn-primary">Create New</a>
                </div>
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                           <tr>
                            <td><button>Edit</button></td>
                            <td>Post Title</td>
                            <td>Post Snipet</td>
                            <td>
                                <form action="{{ route('posts.destroy') }}" method="Post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                </form>
                            </td>
                           </tr> 
                        </thead>
                        
                    </table>
                    @foreach($posts as $post)
                    <h3>{{ url($post['post_title']) }}</h3>
                    <p>{{ url($post['post_content']) }}</p>
                    @endforeach

                    {{ __('You are logged in!') }}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
