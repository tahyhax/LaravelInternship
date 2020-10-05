@include('dashboard.posts.blocks.form.errors')

<form method="POST" action="{{route('posts.store')}}">
    @csrf

    @include('posts.blocks.form.fields')

    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{  url()->previous() }}" class="btn btn-light" role="button">Cancel</a>
    </div>
</form>