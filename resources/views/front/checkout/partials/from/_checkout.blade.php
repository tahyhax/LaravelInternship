<form method="POST" action="{{route('checkout.ordering')}}"
      class="needs-validation {{$errors->any() ? 'was-validated ': ''}}" novalidate>
    @csrf

    @include('front.checkout.partials.from.fields', ['paymentMethods' => $paymentMethods])

    <button type="submit" class="btn btn-primary float-right">{{__('Ordering')}}</button>
</form>
