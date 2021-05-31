<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{config('app.name')}}
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs" class="overdue">Docs</a>
                    <a href="https://laracasts.com">Podcast</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Products</a>
                    <a href="https://forge.laravel.com">Advertise</a>
                    <a href="https://vapor.laravel.com">Presenters</a>
                    <a href="https://github.com/laravel/laravel">Listen Live</a>
                </div>
            </div>
        </div>

        {{ $visitors }}
        @include('footer')
        <span id="demo"></span>
        <form action="{{ route('visitors.store') }}" method="post" id="theForm">
            @csrf
            <input type="hidden" name="ip" id="ip" value="{!! $_SERVER['REMOTE_ADDR'] !!}" class="form-data">
            <input type="submit" id="submit" value="LOG" class="btn btn-primary mb-5">
        </form>

        <!-- scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script>
            // window.alert("sometext");
            document.addEventListener('readystatechange', event => { 

                // When HTML/DOM elements are ready:
                /*if (event.target.readyState === "interactive") {   //does same as:  ..addEventListener("DOMContentLoaded"..
                    alert("hi 1");
                }*/

                // When window loaded ( external resources are loaded too- `css`,`src`, etc...) 
                if (event.target.readyState === "complete") {
                    alert(windowvar.visitors);
                }
            });
            /*$(document).ready(function() {   //same as: $(function() { 
                document.getElementById("theForm").submit();
            });*/
        </script>

    </body>
</html>
