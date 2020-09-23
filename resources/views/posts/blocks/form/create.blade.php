
@include('posts.blocks.form.errors')

<form method="POST" action="{{route('posts.store')}}">
    @csrf

    @include('posts.blocks.form.fields')

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="submit" class="btn btn-primary">Cancel</button>
    </div>
</form>