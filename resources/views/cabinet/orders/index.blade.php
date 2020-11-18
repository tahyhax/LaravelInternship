@extends('cabinet.layouts.app')

@section('title', 'Self orders')

@section('content')
    <h1>Orders list</h1>
    @include('cabinet.orders.partials.table.table', ['orders' => $orders])
@endsection