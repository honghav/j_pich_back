<?php

namespace App\Repositories\Interface;


interface OrdersRepositoriesInterface
{
    public function countDiscount();
    public function all();
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
