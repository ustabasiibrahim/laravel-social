<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService extends BaseService
{
    public function get(array $columns = ['*']): object
    {
        return Post::query()
            ->with(['user', 'channel'])
            ->when(Auth::check(), function ($query) {
                return $query->whereIn('user_id', Auth::user()->followings()->pluck('id'));
            })
            ->popular()
            ->paginate(config('app.per_page'), $columns);
    }

    public function detail(int $id, array $columns = ['*']): Post
    {
        return Post::query()->findOrFail($id, $columns);
    }

    public function create(array $data): Post
    {
        return Post::query()->create($data);
    }

    public function update(int $id, array $data): Post
    {
        $post = Post::findOrFail($id);

        $post->update($data);

        if (isset($data['image'])) {
            $post->addMedia($data['image'])->toMediaCollection('featured');
        }

        return $post;
    }

    public function delete(int $id): bool
    {
        $post = Post::findOrFail($id);

        return $post->delete();
    }
}
