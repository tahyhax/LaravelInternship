@extends('layouts.app')

@section('title', 'Post show')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <div class="mb-1">
                Creator: <small class="text-muted">{{$post->user->name}}</small>
                {{--// NOTE временно сделано пока не разберуть почему на работает $casts--}}
                Created: <small class="text-muted">{{ $post->created_at->isoFormat('DD/MM/Y hh:m') }}</small>
                @if($post->created_at != $post->updated_at)
                    Updated: <small class="text-muted">{{ $post->updated_at->isoFormat('DD/MM/Y hh:mm') }}</small>
                @endif
                Views: <small class="text-muted">{{ $post->views }}</small>
            </div>
            <p class="card-text">{!! $post->body !!}</p>
        </div>
    </div>
@endsection