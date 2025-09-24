<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Services\CategoriesServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BCategoriesController extends Controller
{
     protected $categoriesService;
    public function __construct(CategoriesServices $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }
    
    public function index(): JsonResponse
    {
        $categories = $this->categoriesService->all();
        return response()->json($categories, 200);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $category = $this->categoriesService->create($validated);
        return response()->json($category, 201);
    }

    public function show($id): JsonResponse
    {
        $category = $this->categoriesService->find($id);
        return response()->json($category, 200);
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
$validated = $request->validated();

    // Handle new cover upload
    if ($request->hasFile('cover')) {
        // Optional: delete old cover if needed
        $existing = $this->categoriesService->find($id);
        if ($existing && $existing->cover) {
            Storage::disk('public')->delete($existing->cover);
        }

        $validated['cover'] = $request->file('cover')->store('covers', 'public');
    }

    $category = $this->categoriesService->update($id, $validated);

    return response()->json($category, 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->categoriesService->delete($id);
        return response()->json(null, 204);
    }
}