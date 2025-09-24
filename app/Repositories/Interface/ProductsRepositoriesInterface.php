<?php

namespace App\Repositories\Interface;

interface ProductsRepositoriesInterface
{
    public function all();
    public function allByStatus();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
