@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    @include('posts.blocks.list-title', ['title' => 'Posts', 'subTitle' => 'This post list was generated via the factory.'])
    {{--Todo как вывесте блок с уведомлением если пустой список --}}
    {{--@empty($posts)--}}
        {{--@include('blocks.notice.emptyList', ['message' => 'The list of posts is empty!'])--}}
    {{--@endempty--}}

    <div class="card-deck mb-3 flex-column">
        @each('posts.blocks.list-item', $posts, 'post')
        {{ $posts->links() }}
    </div>

@endsection