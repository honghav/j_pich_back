<?php

namespace App\Services;

use App\Repositories\Interface\OrdersRepositoriesInterface;

class OrdersServices
{
    protected $orderRepository;

    public function __construct(OrdersRepositoriesInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function countDiscount()
    {
        return $this->orderRepository->countDiscount();
    }
    public function getAll()
    {
        return $this->orderRepository->all();
    }

    public function getById(int $id)
    {
        return $this->orderRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->orderRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->orderRepository->delete($id);
    }
}
