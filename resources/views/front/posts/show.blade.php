@extends('front.layouts.app')

@section('title', 'Posts')

@section('content')

    @include('front.posts.partials.list-title', ['title' => $post->title, 'subTitle' => 'This post list was generated via the factory.'])

    <div class="card-deck mb-3 flex-column">
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-1">
                    Creator:
                    <small class="text-muted">{{$post->user->name}}</small>
                    Created:
                    <small class="text-muted">{{ $post->created_at}}</small>
                    @if($post->created_at != $post->updated_at)
                        Updated:
                        <small class="text-muted">{{ $post->updated_at }}</small>
                    @endif
                    Views:
                    <small class="text-muted">{{ $post->views }}</small>

                </div>
                <p class="card-text">{!! $post->body !!}</p>
            </div>
        </div>
    </div>

@endsection