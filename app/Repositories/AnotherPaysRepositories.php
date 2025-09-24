<?php

namespace App\Repositories;

use App\Models\AnotherPays;
use App\Repositories\Interface\AnotherPaysRepositoriesInterface;

class AnotherPaysRepositories implements AnotherPaysRepositoriesInterface
{
    public function all()
    {
        $getall = AnotherPays::orderBy('created_at', 'desc')->get();
        return $getall;
    }

    public function find(int $id) 
    {
        return AnotherPays::find($id);
    }

    public function create(array $data)
    {
        return AnotherPays::create($data);
    }

    public function update(int $id, array $data)
    {
        $anotherPay = AnotherPays::find($id);
        if (!$anotherPay) {
            return null;
        }
        $anotherPay->update($data);
        return $anotherPay;
    }

    public function delete(int $id): bool
    {
        $anotherPay = AnotherPays::find($id);
        if (!$anotherPay) {
            return false;
        }
        return $anotherPay->delete();
    }
}
