<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PostApiStoreRequest;
use App\Http\Requests\Dashboard\PostApiUpdateRequest;
use App\Http\Resources\Dashboard\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{

    protected int $perPage = 10;

    /**
     * @param Request $request
     * @return PostResource
     */
    public function index(Request $request): PostResource
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $posts = Post::query()->orderBy('id', 'DESC')->paginate($perPage);
        return new PostResource($posts);
    }

    /**
     * @param PostApiStoreRequest $request
     * @return PostResource
     */
    public function store(PostApiStoreRequest $request): PostResource
    {
        $post = Post::create($request->all());

        return new PostResource($post);
    }

    /**
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * @param PostApiUpdateRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostApiUpdateRequest $request, Post $post): PostResource
    {
        $post->update($request->all());

        return new PostResource($post);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
