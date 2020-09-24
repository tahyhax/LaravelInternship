@extends('layouts.app')

@section('title', 'Post edit')

@section('content')

    @include('posts.blocks.form.edit', ['post' => $post])

@endsection