<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function get(array $columns = ['*']): array
    {
        return Post::query()->get($columns);
    }

    public function findById(int $id, array $columns = ['*']): object
    {
        return Post::query()->findOrFail($id, $columns);
    }

    public function findBySlug(string $slug, array $columns = ['*']): object
    {
        return Post::query()->where('slug', $slug)->firstOrFail($columns);
    }

    public function create(array $data): object
    {
        return Post::query()->create($data);
    }

    public function update(Post $post, array $data): object
    {
        $post->update($data);

        return $post;
    }
}
