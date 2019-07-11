@extends('layouts.app')

@section('content')
    
    <a href="{{url('/posts')}}" class="btn btn-primary">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {!! $post->body !!} <!-- Parse HTML Contents-->
    </div>
    <hr>
    <small class="card-text">Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    {{-- @if(!Auth::guest()) --}}
    @auth
        @if (Auth::user()->id == $post->user_id)
            <a href="{{url('/posts').'/'.$post->id.'/edit'}}" class="btn btn-success">Edit</a>
        
            {!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'float-right']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}
        @endif
    {{-- @endif --}}
    @endauth

@endsection
