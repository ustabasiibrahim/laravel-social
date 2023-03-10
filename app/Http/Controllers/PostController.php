<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Auth\Access\AuthorizationException;
use function count;

class PostController extends Controller
{
    public function __construct(public PostService $post_service)
    {
    }

    /**
     * @throws AuthorizationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
       $posts = $this->post_service->getPostStatisticById([1,2,3]);

        return $this->success(PostResource::collection($posts));
    }

    public function store(PostStoreRequest $request)
    {
        $post = $this->post_service->create($request->validated());

        return $this->created(PostResource::make($post));
    }

    public function show($id)
    {
        $post = $this->post_service->findById($id);

        return $this->success(PostResource::make($post));
    }

    public function update($id, PostUpdateRequest $request)
    {
        $post = $this->post_service->update($id, $request->validated());

        return $this->success(PostResource::make($post));
    }

    public function destroy($id)
    {
        /** @var Post $resource */

        $resource = $this->post_service->findById($id);

        $resource->delete();

        return $this->deleted();
    }
}
