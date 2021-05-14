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
                    <h1>{{ __('Create New Profile') }} 
                    @if(Auth::user()->profile)<a href="{{ route('profiles.index') }}" style="float: right; clear: both; color: #fff; font-weight: bold;" class="btn btn-info">View Profile</a></h1>
                    @endif
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form enctype="multipart/form-data" action="{{ route('profiles.store') }}" method="post">
                        
                        @csrf

                        <input type="file" name="image" class="form-control" required>

                        <input type="hidden" name="username" value="{{ Auth::user()->email }}" required>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>

                        <input type="submit" value="Upload" class="btn btn-info mt-3">
                        
                    </form>
                    
                    @if($img)
                    @if($img->user_id == Auth::user()->id)
                      @if(session()->has('success'))
                        @foreach($img->image as $img)
                        <img src="{{ url($img['image_path']) }}" class="d-block w-100 img1" alt="{{ $img['image'] }}" />
                        @endforeach
                      @endif
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
