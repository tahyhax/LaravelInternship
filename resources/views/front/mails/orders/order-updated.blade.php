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
    @foreach($order->products as $product)
        <tr class="hover:bg-grey-lighter">
            <th scope="row">{{ $loop->index +1 }}</th>
            <td><a href="{{route('products.show', [
                'product' => $product->slug,
            ])}}">{{ $product->name }}</a></td>
            <td>{{ $product->orderItem->qty }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->orderItem->qty * $product->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
