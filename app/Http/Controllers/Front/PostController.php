<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PostController extends Controller
{

    /**
     * @var int
     */
    protected int $perPage = 10;

    /**
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        return view('front.posts.index')->with(
            [
                'posts' => Post::query()->with('user')
                    ->orderByDesc('id')
                    ->paginate($this->perPage),
            ]
        );
    }

    /**
     * @param Post $post
     * @return Factory|View
     */
    public function show(Post $post): Factory|View
    {
        return view('front.posts.show')->with(['post' => $post->load('user')]);
    }
}
