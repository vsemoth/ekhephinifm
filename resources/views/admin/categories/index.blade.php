@extends('layouts.app')

@section('title')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <h1>Categories</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($categories))
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div><!-- end of col-md-8 -->
            
            <div class="well">
                <div class="offset-1">                    
                    <form action="{{route('categories.store')}}" method='post'>

                        @csrf

                        <h2>New Category</h2>

                        <label for='category_name'>Category Name</label>
                        <input type="text" name="category_name" class="form-control">

                        <input type="submit" name="submit" value="Create" class="btn btn-primary mt-3">

                    </form>

                    @if (session('success'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

@endsection