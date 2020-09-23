@include('posts.blocks.form.errors')

<form method="POST" action="{{route('posts.update',['post' => $post->id])}}">
    @csrf
    @method('PUT')
    @include('posts.blocks.form.fields', ['post' => $post])
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
        {{--<button type="submit" class="btn btn-primary">Cancel</button>--}}
    </div>
</form>