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
            <x-carousel-component :items="$category->images"></x-carousel-component>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <x-product-card-component :product="$product"></x-product-card-component>
                </div>
            @endforeach
        </div>
        {{$products->appends(request()->query())->links()}}

    </div>
@endsection