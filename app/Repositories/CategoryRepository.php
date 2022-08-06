<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    /**
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getLatest()
    {
        return $this->model::query()->latest()->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllActive()
    {
        return $this->model::query()->where('is_active', 1)->latest()->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getActivePluck($value = 'name', $key = 'id')
    {
        return $this->getAllActive()->pluck($value, $key);
    }
}
