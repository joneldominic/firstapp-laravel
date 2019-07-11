@extends('layouts.app')

@section('content')
    
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>This is the Home Page</p>
        
        @guest
            <p>
                <a class="btn btn-primary btn-lg" href="{{url('/login')}}" role="button">Login</a>
                <a class="btn btn-success btn-lg" href="{{url('/register')}}" role="button">Register</a>
            </p>   
        @endguest
    </div>

@endsection
