<?php

namespace App\Repositories;

use App\Models\Products;
use App\Repositories\Interface\ProductsRepositoriesInterface;

class ProductsRepositories implements ProductsRepositoriesInterface
{
    protected $model;

    public function __construct(Products $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')->orderBy('created_at', 'desc')->get();
    }
    public function allByStatus()
    {
        return $this->model->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')->orderBy('created_at', 'desc')->where('status' , 'active')->get();
    }

    public function find($id)
    {
        return $this->model->with('category')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product->delete();
    }
}
