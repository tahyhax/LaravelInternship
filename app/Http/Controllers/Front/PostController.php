<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{

    /**
     * @var int
     */
    protected $perPage = 10;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('front.posts.show')->with(['post' => $post->load('user')]);
    }
}
