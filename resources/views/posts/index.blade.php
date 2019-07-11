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
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="{{url('/storage/cover_images').'/'.$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8"> 
                        <h3 class="card-title"><a href="{{url('/posts').'/'.$post->id}}">{{$post->title}}</a></h3>
                        <small class="card-text">Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
            </div>
        </div>    
    @empty
        <p>No Post Found!</p>
    @endforelse
   
@endsection
