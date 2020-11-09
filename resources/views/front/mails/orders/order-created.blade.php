@component('mail::message')
    # Order: **{{$order->slug}}** status ``{{$order->status}}``

    @component('mail::table')
        Name  | Price  | Qty  | Total
        --- |---|--- |---
        @foreach($order->products as $item)
            {{$item->name}}    | {{$item->price}}  |   {{$item->price}}  | {{$item->price * $item->orderItem->qty}}
        @endforeach
    @endcomponent

    @component('mail::footer')
        Thanks,<br>
        [{{ config('app.name') }}]

    @endcomponent
@endcomponent