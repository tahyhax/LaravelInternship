@extends('front.layouts.app')

@section('title', 'Main')

@section('sidebar-left')
    <div class="col-lg-3">
        @include('front.layouts.partials.sidebar._categories')
    </div>
@endsection
@section('content')
    <div class="col-lg-9">
        <div class="mb-4">
            {{--//TODO передать $items после добавления  можели  ImageLoader--}}
            <x-carousel :items="[1,2,4,5]"></x-carousel>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <x-products.product-card :product="$product"></x-products.product-card>
                </div>
            @endforeach
        </div>
        {{$products->links()}}
    </div>
@endsection