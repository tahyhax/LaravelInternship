@include('cabinet.customer-info.partials.form._errors')

<form method="POST" action="{{route('cabinet.customer-info.update',['customer' => $customer])}}">
    @csrf
    @method('PUT')
    @include('cabinet.customer-info.partials.form._fields', ['customer' => $customer])
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{  url()->previous() }}" class="btn btn-light" role="button">{{__('Cancel')}}</a>
    </div>
</form>