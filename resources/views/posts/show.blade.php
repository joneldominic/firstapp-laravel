@extends('layout.app')

@section('content')
    
    <a href="{{url('/posts')}}" class="btn btn-primary">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {!! $post->body !!} 
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>

   
@endsection
