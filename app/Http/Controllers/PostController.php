<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function __construct(public PostService $post_service)
    {
    }

    public function index(): JsonResponse
    {
       $posts = $this->post_service->get();

        return $this->success(PostResource::collection($posts));
    }

    public function store(PostStoreRequest $request): JsonResponse
    {
        $post = $this->post_service->create($request->validated());

        return $this->created(PostResource::make($post));
    }

    public function show($id): JsonResponse
    {
        $post = $this->post_service->detail($id);

        return $this->success(PostResource::make($post));
    }

    public function update($id, PostUpdateRequest $request): JsonResponse
    {
        $post = $this->post_service->update($id, $request->validated());

        return $this->success(PostResource::make($post));
    }

    public function destroy($id): JsonResponse
    {
        /** @var Post $post */

        $this->post_service->delete($id);

        return $this->deleted();
    }
}
