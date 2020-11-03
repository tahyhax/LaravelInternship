<form method="POST" action="{{route('checkout.ordering')}}">
    @csrf


    <div class="form-row">
        <div class="form-group col-6">
            <label for="last_name">First name</label>
            <input type="text" name="last_name" class="form-control" id="last_name">
        </div>

        <div class="form-group col-6">
            <label for="first_name">Last name</label>
            <input type="text" name="first_name" class="form-control" id="first_name">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-6">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
        </div>

        <div class="form-group col-6">
            <label for="phone">Phone</label>
            <input type="text" name="email" class="form-control" id="phone" placeholder="+38095-121-21-23">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-9">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address">
        </div>
        <div class="form-group col-3">
            <label for="payment-methods">{{__('Payment Method')}}</label>
            <select class="form-control"  name="paymentMethod" id="payment-methods">
                @foreach($paymentMethods as $paymentMethod)
                    <option value="{{$paymentMethod->id}}">{{$paymentMethod->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-12">
            <label for="notice">{{__('Notice')}}</label>
            <textarea  name="notice" class="form-control" id="notice" rows="5"></textarea>
        </div>
    </div>
    {{--<div class="form-group">--}}
        {{--<label for="address">Address</label>--}}
        {{--<input type="text" name="address" class="form-control" id="address">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--<label for="payment-methods">{{__('Payment Methods')}}</label>--}}
        {{--<select class="form-control"  name="paymentMethod" id="payment-methods">--}}
            {{--@foreach($paymentMethods as $paymentMethod)--}}
                {{--<option value="{{$paymentMethod->id}}">{{$paymentMethod->name}}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}


    <button type="submit" class="btn btn-primary float-right">{{__('Ordering')}}</button>
</form>

{{--@include('posts.blocks.form.errors')--}}

{{--<form method="POST" action="{{route('posts.store')}}">--}}
    {{--@csrf--}}

    {{--@include('posts.blocks.form.fields')--}}

    {{--<div class="form-group d-flex justify-content-end">--}}
        {{--<button type="submit" class="btn btn-primary">Save</button>--}}
        {{--<a href="{{  url()->previous() }}" class="btn btn-light" role="button">Cancel</a>--}}
    {{--</div>--}}
{{--</form>--}}