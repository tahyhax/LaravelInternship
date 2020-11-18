<tr>
    <th scope="row">1</th>
    <th>{{ link_to(route('cabinet.orders.show', ['order' => $order]), $order->slug) }}</th>
    <th>{{$order->full_name}}</th>
    <th>{{$order->email}}</th>
    <th>{{$order->phone}}</th>
    <th>{{$order->address}}</th>
    <th>{{$order->created_at}}</th>
    <th>{{$order->status}}</th>
</tr>