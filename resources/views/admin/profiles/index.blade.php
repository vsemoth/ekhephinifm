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
                    @if(!Auth::user()->profile)
                    <h2>{{ __('Profiles') }} <a href="{{ route('profiles.create') }}" style="float: right;" class="btn btn-primary">Upload Image</a></h2>
                    @endif
                    @if(Auth::user()->profile)
                    <h2>{{ __('Profile') }} <a href="{{ route('profiles.edit',Auth::user()->profile->id) }}" style="float: right;" class="btn btn-warning">Edit Profile</a></h2>
                    @endif
                    <!-- {{-- <h2>{{ __('Profile') }} <a href="{{ route('profiles.edit',$profile->id) }}" style="float: right;" class="btn btn-warning">Edit Profile</a></h2> --}} -->
                </div>
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <div class="row">
                    @foreach($profiles as $profile)
                    @if(Auth::user()->id == $profile->user_id)
                        @if($profile->user_id != null)
                        <div class="col-md-8">

                            <h2>User Details:</h2>
                            
                           <table class="table">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>First Name:</td>
                                            <td>Last Name:</td>
                                            <td>|</td>
                                            <td>Username:</td>
                                            <td>Email Address:</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($profiles)
                                        @foreach($profiles as $profile)
                                            @if(Auth::user()->id == $profile->user_id)
                                            <tr>
                                                <td>{{ $profile->id }}</td>
                                                <td>{{ Auth::user()->first }}</td>
                                                <td>{{ Auth::user()->last }}</td>
                                                <td>|</td>
                                                <td>{{ $profile->username }}</td>
                                                <td>{{ Auth::user()->email }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>

                        </div><!-- end of col-md-8 -->
                        @endif
                    @endif
                    @endforeach
                        
                        <div class="well">                        
                            @if($profiles)
                            @foreach($profiles as $profile)
                            @if($profile->user_id == Auth::user()->id)
                            @foreach($profile->image as $image)
                            @if(!empty($image->image))
                                <h2>User Image:</h2>
                                <img height="200px" src="{{ url($image['image_path']) }}" class="d-block img1" alt="{{ $image['image'] }}" />
                            @else
                                <h2 class="mt-3">Upload Your User Image:</h2>
                                <div class="col-sm-4">
                                    <div class="item">
                                        <a href="{{ route('profiles.create') }}">
                                            <span class="notify-badge">NEW</span>
                                            <img src="http://placehold.it/200x200"  alt="" />
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            @endif                
                        </div>
                    </div><!-- End of row -->

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
