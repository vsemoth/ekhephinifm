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
                    <h1>{{ __('Create New Profile') }} <a href="{{ route('profiles.index') }}" style="float: right; clear: both; color: #fff; font-weight: bold;" class="btn btn-info">View Profile</a></h1>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profile_image" class="form-control">
                        <input type="submit" value="Upload" class="btn btn-info mt-3">
                    </form>

                    @if($img)
                      @if(session()->has('success'))
                        <img src="{{ url($img['image_path']) }}" class="d-block w-100 img1" alt="{{ $img['image'] }}" />
                      @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
