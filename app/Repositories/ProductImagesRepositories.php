<?php

namespace App\Repositories;

use App\Models\ProductImages;
use App\Repositories\Interface\ProductImagesRepositoriesInterface;

class ProductImagesRepositories implements ProductImagesRepositoriesInterface
{
    public function all()
    {
        return ProductImages::with('product')->latest()->get();
    }

    public function find($id)
    {
        return ProductImages::findOrFail($id);
    }

    public function store(array $data)
    {
         $created = [];

        // Ensure at least one image exists
        if (!empty($data['image_path'])) {
            foreach ($data['image_path'] as $path) {
                $created[] = ProductImages::create([
                    'product_id' => $data['product_id'],
                    'image_path'       => $path, // ✅ Always insert image
                ]);
            }
    }

    return $created;
        // return ProductImages::create($data);
    }

    public function update($id, array $data)
    {
        $image = ProductImages::findOrFail($id);
        $image->update($data);
        return $image;
    }

    public function delete($id)
    {
        return ProductImages::destroy($id);
    }
}
