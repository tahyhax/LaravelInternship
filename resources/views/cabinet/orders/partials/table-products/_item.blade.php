<tr>
    <th scope="row">1</th>
    <th>{{ link_to(route('products.show', ['product' => $product]), $product->name, ['target'=> '_blank']) }}</th>
    <th>{{$product->orderItem->qty}}</th>
    <th>@money($product->price)</th>
    <th>@money($product->price * $product->orderItem->qty)</th>
</tr>