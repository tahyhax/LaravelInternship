<div>
    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Order')}}</span>
        </div>
        <div class="offset-1 col-6 font-weight-bold">
            {{$order->slug}}
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Full Name')}}</span>
        </div>
        <div class="offset-1 col-6">
            {{$order->full_name}}
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Address')}}</span>
        </div>
        <div class="offset-1 col-6">
            {{$order->address}}
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Email')}}</span>
        </div>
        <div class="offset-1 col-6">
            {{$order->email}}
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Phone')}}</span>
        </div>
        <div class="offset-1 col-6">
            {{$order->phone}}
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Status')}}</span>
        </div>
        <div class="offset-1 col-6">
            {{$order->status}}
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Payment method')}}</span>
        </div>
        <div class="offset-1 col-6">
            {{$order->paymentMethod->name}}
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-2 ">
            <span class="font-weight-bold">{{__('Created')}}</span>
        </div>
        <div class="offset-1 col-6">
            {{$order->created_at}}
        </div>
    </div>
    @if($order->created_at != $order->updated_at)
        <div class="row mb-1">
            <div class="col-2 ">
                <span class="font-weight-bold">{{__('Updated')}}</span>
            </div>
            <div class="offset-1 col-6">
                {{$order->updated_at}}
            </div>
        </div>
    @endif
</div>