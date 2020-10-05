@extends('front.layouts.app')

@section('title', 'Post edit')

@section('content')

    @include('front.posts.blocks.form.edit', ['post' => $post])

@endsection