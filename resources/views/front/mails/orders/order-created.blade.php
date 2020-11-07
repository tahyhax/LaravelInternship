{{--@component('mail::header', ['url' => config('app.url')])--}}

@component('mail::message')
    @component('mail::header')
        # Order: **{{$order->slug}}** status ``{{$order->status}}``
    @endcomponent

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