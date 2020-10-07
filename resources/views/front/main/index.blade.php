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
            {{--//TODO сделать как каомонет или уточнить как правально будет реализовать--}}
            @include('front.main.partials._slider')
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    @include('front.main.partials._products-list-item', ['product' => $product])
                </div>
            @endforeach
        </div>
        {{$products->links()}}
    </div>
@endsection