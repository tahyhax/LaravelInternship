
<table class="table">

    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Qty</th>
        <th scope="col">Price</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr class="hover:bg-grey-lighter">
            <th scope="row">{{ $loop->index +1 }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->qty }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->total }}</td>
        </tr>
    @endforeach

    <tr>
        <th scope="row" colspan="6" class="text-right">
            <p class="text-danger"><strong >Total:</strong> {{ $total }}</p>
        </th>
    </tr>

    </tbody>
</table>
<div class="float-right">
    <a href="{{route('cart')}}" type="button" class="btn btn-outline-info ">{{__(' Edit cart')}}</a>
</div>