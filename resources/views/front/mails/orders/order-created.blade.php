@component('mail::message')
# Order: **{{$order->slug}}** status `New`

@component('mail::table')
| Name       |  Qty  | Price |  Total|
|:---------- |:-----:| -----:| -----:|
@foreach($order->products as $item)
| {{$item->name}} | {{$item->qty}} | @money($item->price)  | @money($item->price * $item->orderItem->qty)|
@endforeach
@endcomponent

@component('mail::footer')
Thanks,<br>
[{{ config('app.name') }}]

@endcomponent
@endcomponent