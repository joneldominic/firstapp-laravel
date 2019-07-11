<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'FirstApp')}}</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        @include('includes.navbar')
        
        <div class="container">
            @include('includes.messages')
            @yield('content')
        </div>
    
        {{-- Careful with the url() --}}
        <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
        <script>
            CKEDITOR.replace('article-ckeditor');
        </script>
    </body>
</html>
