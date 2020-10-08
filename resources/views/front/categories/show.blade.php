@extends('front.layouts.app')

@section('title', $category->name)

@section('sidebar-left')
    <div class="col-lg-3">
        @include('front.layouts.partials.sidebar._categories')
    </div>
@endsection
@section('content')
    <div class="col-lg-9">
        <div class="mb-4">
            {{--//TODO передать $items после добавления  можели  ImageLoader--}}
            <x-the-carousel ></x-the-carousel>
        </div>

        <div class="row">
            @foreach($category->products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    @include('front.main.partials._products-list-item', [
                    'category' => $category,
                    'product' => $product
                    ])
                </div>
            @endforeach
        </div>
    </div>
@endsection