@extends('front.layouts.app')

<table class="table">

    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Qty</th>
            <th scope="col">Price</th>
            <th scope="col">Total</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr class="hover:bg-grey-lighter">
                <th scope="row">{{ $loop->index +1 }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->total }}</td>
                <td>

                    <button wire:click="remove({{ $product->id }})" wire:loading.attr="disabled" class="btn btn-danger">
                    <span wire:loading.class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                       {{__('Remove')}}
                    </button>
                </td>
            </tr>
        @empty
            <tr class="text-center p-6 ">
                <th class="text-lg" colspan="6">Your cart is empty!</th>
            </tr>
        @endforelse
        @if($products)
            <tr>
                <th scope="row" colspan="6" class="text-right">
                    <strong class="">Total:</strong> &pound;{{ $this->total }}
                </th>
            </tr>
        @endif

    </tbody>
</table>
@if($products)
    <div class="float-right">
        <div class="flex-auto">

        </div>
        <button wire:click="checkout()"
                class=" btn btn-success">
            Checkout
        </button>
    </div>
@endif

