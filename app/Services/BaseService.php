<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Model $model
 */
class BaseService
{
    public function __construct(public $model)
    {
    }

    public function get(array $columns = ['*']): object
    {
        return $this->model->query()->get($columns);
    }

    public function findById(int $id, array $columns = ['*']): object
    {
        return $this->model->query()->findOrFail($id, $columns);
    }

    public function findBySlug(string $slug, array $columns = ['*']): object
    {
        return $this->model->query()->where('slug', $slug)->firstOrFail($columns);
    }

    public function create(array $data): object
    {
        return $this->model->query()->create($data);
    }

    public function update(int $id, array $data): object
    {
        $model = $this->findById($id);

        $model->update($data);

        return $model;
    }
    /**
     * @param $id
     * @return void
     */
    protected function deleteMediaByPost($id): void
    {
        $post = $this->findById($id);

        $post->getMedia()->each(function ($media) {
            $media->delete();
        });
    }
}
