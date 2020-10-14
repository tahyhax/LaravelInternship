@extends('cabinet.layouts.app')

@section('title', 'Personal info edit')

@section('content')

    @include('cabinet.customer-info.partials.form._edit', ['customer' => $customer])

@endsection