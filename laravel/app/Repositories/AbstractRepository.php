<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    private string $modelClass;
    protected Model $model;

    public function __construct(?string $modelClass = null)
    {
        $this->modelClass = $modelClass ?: self::guessModelClass();
        $this->model = app($this->modelClass);
    }

    private static function guessModelClass(): string
    {
        return preg_replace('/(.+)\\\\Repositories\\\\(.+)Repository$/m', '$1\Models\\\$2', static::class);
    }

    public function getOneById($id): ?Model
    {
        return $this->model->find($id);
    }

    /** @return Collection|array<Model> */
    public function getByIds(array $ids): Collection
    {
        return $this->model->find($ids);
    }

    /** @return Collection|array<Model> */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getFirstWhere(...$params): ?Model
    {
        return $this->model->firstWhere(...$params);
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}
