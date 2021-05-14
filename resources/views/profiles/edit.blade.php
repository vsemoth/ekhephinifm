@extends('layouts.app')
                @if(!Auth::user())
                        <script>window.location = "/home";</script>
                @endif
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="card-header">
                    <h1>{{ __('Edit Profile') }} <a href="{{ route('profiles.index') }}" style="float: right; clear: both; color: #fff; font-weight: bold;" class="btn btn-primary">View Profile</a></h1>
                </div>
                </div>
                <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                    {{ __('You are logged in!') }}
                    <div class="row">
                        <div class="col-md-8">

                            <h2>User Details:</h2>
                            
                           <table class="table">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>First Name:</td>
                                            <td>Last Name:</td>
                                            <td>Action_1:</td>
                                            <td>Username:</td>
                                            <td>Action_2:</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($profile)
                                            @if(Auth::user()->id == $profile->user_id)
                                    <form action="{{ route('users.update',$profile->user['id']) }}" method="post">
                                        @csrf
                                            <tr>
                                                <td>{{ $profile->id }}</td>
                                                <input type="hidden" name="status" value="{{ $profile->user['status'] }}">
                                                <td><input type="text" name="first" value="{{ $profile->user['first'] }}"></td>
                                                <td><input type="text" name="last" value="{{ $profile->user['last'] }}"></td>
                                                <input type="hidden" name="email" value="{{ $profile->user['email'] }}">
                                            @method('PUT')
                                                <td><button type="submit" class="btn btn-info btn-sm">Update Details</button></td>
                                    </form>
                                    <form style="float: left;" action="{{ route('profiles.update',$profile->id) }}" method="post">
                                        @csrf
                                                <td><input type="text" name="username" value="{{ $profile->username }}"></td>
                                            @method('PUT')
                                                <td><button type="submit" class="btn btn-info btn-sm">Change Username</button></td>
                                    </form>
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                        </div><!-- end of col-md-8 -->
                        
                        <div class="well" style="clear:both; margin-top: 140px;">
                            <div class="offset-4">
                                @if($profile)
                                    @if(Auth::user()->id == $profile->user_id)
                                        <div class="col-sm-4">
                                            <div class="item">
                                                <a href="#">
                                                    <span data-toggle="modal" data-target="#myModal" class="notify-badge">NEW</span>
                                                </a>
                                                @foreach($profile->image as $image)
                                                    <img src="{{ url($image->image_path) }}" style="border-radius: 50%;" height="200px" class="d-block img1" alt="{{ $image->image }}" />
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                    @endif
                                @endif
                            </div>
                        </div>
                        <h4>User Image</h4>

                        <a href="#" data-toggle="modal" data-target="#Modal_1" class="btn btn-warning bolder">Update Email Address</a>
<!-- Modal_1 -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="container modal-content">
        <form enctype="multipart/form-data" action="{{ route('images.create') }}" method="post">
            <div class="modal-header">
                @csrf
                <h2>Image Upload</h2>
            </div>
            <div class="modal-body">
                <input type="file" name="image" class="form-control">
                <button type="submit" class="btn btn-success btn-sm mt-3">Upload</button>
            </div>
        </form>
            <div class="modal-footer">
        <h4 class="modal-title"><button type="button" class="close" data-dismiss="modal">&times;Close</button></h4>
            </div>
    </div>

  </div>
</div>

<!-- Modal_2 -->
<div id="Modal_1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="container modal-content">
        <form action="{{ route('users.update', $profile->user['id']) }}" method="post">
            <div class="modal-header">
                @csrf
                <h2>Email Edit</h2>
            </div>
            <div class="modal-body">
                <input type="hidden" name="status" value="{{ $profile->user['status'] }}">
                <input type="hidden" name="first" value="{{ $profile->user['first'] }}">
                <input type="hidden" name="last" value="{{ $profile->user['last'] }}">
                <input type="email" name="email" value="{{ $profile->user['email'] }}">
                <hr>
                @method('PUT')
                <button type="submit" class="btn btn-success btn-sm mt-3">Update</button>
            </div>
        </form>
            <div class="modal-footer">
        <h4 class="modal-title"><button type="button" class="close" data-dismiss="modal">&times;Close</button></h4>
            </div>
    </div>

  </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
