<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct(public PostService $post_service)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index()
    {
        // check if the user has the right permission
        $this->authorize('viewAny', Post::class);

        // get all posts
        $posts = $this->post_service->get();

        return $this->respondWithSuccess(PostResource::collection($posts));

    }

    public function store(Request $request)
    {
    }

    public function show(Post $post)
    {
    }

    public function update(Request $request, Post $post)
    {
    }

    public function destroy(Post $post)
    {
    }
}
