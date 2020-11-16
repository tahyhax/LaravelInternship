@extends('cabinet.layouts.app')

@section('content')
    <div class="col-6">
        <div class="row mb-1">
            <div class="col-2 ">
                <span class="font-weight-bold">{{__('Name')}}</span>
            </div>
            <div class="offset-1 col-6">
                {{$customer->name}}
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-2 ">
                <span class="font-weight-bold">{{__('Email')}}</span>
            </div>
            <div class="offset-1 col-6">
                {{$customer->email}}
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('cabinet.customer-info.edit', ['customer' => $customer->id])}}"
           role="button">Edit</a>
    </div>
@endsection