<?php 
namespace App\Repositories\Interface;

interface ProductImagesRepositoriesInterface
{
    public function all();
    public function find($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}
