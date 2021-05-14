@extends('layouts.app')
                @if(!Auth::user())
                        <script>window.location = "/home";</script>
                @endif
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                @if(!empty(Auth::user()))
                    @if(Auth::user()->status != 1)
                        <script>window.location = "/home";</script>
                    @endif
                @endif
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

                    @if(!empty(Auth::user()))
                    @if(Auth::user()['status'] == 1)
                    <table class="table">
                        <thead>

                            <tr>
                                <td>#</td>
                                <td>User ID:</td>
                                <td>Username:</td>
                                <td>Presenter Status:</td>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->id }}</td>
                                <td>{{ $profile->user_id }}</td>
                                <td>{{ $profile->username }}</td>
                                <!-- <td>{{ $profile }}</td> -->
                                @if(!$profile->presenter)
                                <td>
                                    <form action="{{ route('presenters.store') }}" method="POST">

                                        @csrf

                                        <input id="presenter_status" type="hidden" value="1" class="form-control @error('presenter_status') is-invalid @enderror" name="presenter_status" required>
                                        @error('presenter_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input id="username" type="hidden" value="{{ $profile->username }}" class="form-control @error('username') is-invalid @enderror" name="username" required>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input type="hidden" name="profile_id" value="{{ $profile->id }}" class="form-control @error('profile_id') is-invalid @enderror" name="profile_id" required>
                                        @error('profile_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input type="submit" value="listener" class="btn btn-info btn-sm" style="width: 60px;">

                                    </form>
                                </td>
                                @endif
                                @foreach($presenters as $presenter)
                                @if($presenter->profile_id == $profile->id)
                                @if($presenter->presenter_status == 1)
                                <td style="width: 100px;">
                                    <form action="{{ route('presenters.update',$presenter->id) }}" method="POST">
                                        @csrf
                                        <input id="presenter_status" type="hidden" value="0" class="form-control @error('presenter_status') is-invalid @enderror" name="presenter_status" required>
                                        <input type="hidden" name="profile_id" value="{{ $profile->id }}">

                                        @error('presenter_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @method('patch')
                                        <input type="submit" value="presenter" class="btn btn-success btn-sm" style="width: 100px;">
                                    </form>
                                </td>
                                @elseif($presenter->presenter_status == 0)
                                <td style="width: 100px;">
                                    <form action="{{ route('presenters.update',$presenter->id) }}" method="POST">
                                        @csrf
                                        <input id="presenter_status" type="hidden" value="1" class="form-control @error('presenter_status') is-invalid @enderror" name="presenter_status" required>
                                        <input type="hidden" name="profile_id" value="{{ $profile->id }}">

                                        @error('presenter_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @method('patch')
                                        <input type="submit" value="listener" class="btn btn-info btn-sm" style="width: 100px;">
                                    </form>
                                </td>
                                @endif
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
