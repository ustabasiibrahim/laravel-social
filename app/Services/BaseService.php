<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Model $model
 */
abstract class BaseService
{
    public function __construct(public $model)
    {
    }

    public function get(array $columns = ['*']): array
    {
        return $this->model->query()->get($columns);
    }

    public function findById(int $id, array $columns = ['*']): object
    {
        return $this->model->query()->findOrFail($id, $columns);
    }

    /**
     * @param string $slug
     * @param array $columns
     * @return object
     */
    public function findBySlug(string $slug, array $columns = ['*']): object
    {
        return $this->model->query()->where('slug', $slug)->firstOrFail($columns);
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->model->query()->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return object
     */
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
