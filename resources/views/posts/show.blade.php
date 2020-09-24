@extends('layouts.app')

@section('title', 'Post show')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->body}}</p>
            <p class="card-text">
                <small class="text-muted">Last updated 3 mins ago</small>
            </p>
        </div>
    </div>
@endsection