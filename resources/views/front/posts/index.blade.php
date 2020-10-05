@extends('front.layouts.app')

@section('title', 'Posts')

@section('content')

    @include('front.posts.blocks.list-title', ['title' => 'Posts', 'subTitle' => 'This post list was generated via the factory.'])
    @auth
        <div class="button-group d-flex justify-content-end mb-3">
            <a class="btn btn-lg btn-primary mr-1" href="{{route('posts.create')}}" role="button">Create</a>
        </div>
    @endauth

    {{--Todo как вывесте блок с уведомлением если пустой список --}}
    {{--@empty($posts)--}}
        {{--@include('blocks.notice.emptyList', ['message' => 'The list of posts is empty!'])--}}
    {{--@endempty--}}

    <div class="card-deck mb-3 flex-column">
        @each('front.posts.blocks.list-item', $posts, 'post')
        {{ $posts->links() }}
    </div>

@endsection