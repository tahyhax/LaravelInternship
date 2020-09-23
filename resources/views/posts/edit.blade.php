@extends('layouts.app')
{{--{{dd($post)}}--}}
@section('content')

    @include('posts.blocks.form.edit', ['post' => $post])

@endsection