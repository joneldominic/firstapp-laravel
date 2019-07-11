@extends('layouts.app')

@section('content')
    
    <h1>Posts</h1>
    {{--@if(count($posts)>0)
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-block">
                        <h3 class="card-title"><a href="{{url('/posts').'/'.$post->id}}">{{$post->title}}</a></h3>
                        <small class="card-text">Written on {{$post->created_at}}</small>
                </div>
            </div>    
        @endforeach

        {{$posts->links()}} <!-- Create Pagination Links!>
            
    @else
        <p>No Post Found!</p>
    @endif --}}
    
    @forelse ($posts as $post)
        <div class="card">
            <div class="card-block">
                    <h3 class="card-title"><a href="{{url('/posts').'/'.$post->id}}">{{$post->title}}</a></h3>
                    <small class="card-text">Written on {{$post->created_at}} by {{$post->user->name}}</small>
            </div>
        </div>    
    @empty
        <p>No Post Found!</p>
    @endforelse
   
@endsection
