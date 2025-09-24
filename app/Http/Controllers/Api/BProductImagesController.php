<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImagesRequest;
use App\Models\ProductImages;
use App\Services\ProductImagesServices;
use App\Services\ProductService;

class BProductImagesController extends Controller
{
    //
    protected $service;

    public function __construct(ProductImagesServices $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $images = $this->service->getAll();
        return response()->json($images);
    }

    public function store(ProductImagesRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image_path')) {
            $paths = [];
            foreach ($request->file('image_path') as $file) {
                $paths[] = $file->store('product_images', 'public');
            }
            $data['image_path'] = $paths;
        }
        $storedImages = $this->service->create($data);
        return response()->json([
            'message' => 'Images uploaded successfully',
            'data' => $storedImages
        ], 201);
    }

    public function getAllByProduct($productId)
    {
        try {
            // fetch images for a given product
            $images = ProductImages::where('product_id', $productId)->get();

            if ($images->isEmpty()) {
                return response()->json([
                    'message' => 'No images found for this product',
                    'data' => []
                ], 200); // return empty array, not an error
            }

            return response()->json($images, 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function show($id)
    {
        $image = $this->service->getById($id);
        return response()->json($image);
    }

    public function update(ProductImagesRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $path = $file->store('product_images', 'public');
                $this->service->create([
                    'product_id' => $request->product_id,
                    'image_path' => $path,
                ]);
            }
        } elseif (is_array($request->image_path)) {
            foreach ($request->image_path as $path) {
                $this->service->create([
                    'product_id' => $request->product_id,
                    'image_path' => $path,
                ]);
            }
        }

        $image = $this->service->update($id, $data);
        return response()->json($image);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Image deleted successfully']);
    }
}
