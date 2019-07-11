@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                    <div class="panel-body">
                        <a href="{{url('/posts/create')}}" class="btn btn-primary">Create Post</a>
                        <h3>Your Blog Post</h3>

                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
