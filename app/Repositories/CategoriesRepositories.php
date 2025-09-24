<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Models\Category;
use App\Repositories\Interface\CategoriesRepositoriesInterface;

class CategoriesRepositories implements CategoriesRepositoriesInterface
{
    protected $model;

    public function __construct(Categories $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);
        return $category->delete();
    }
}
