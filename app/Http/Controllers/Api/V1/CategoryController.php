<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CategoryRequest;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api\V1
 */
class CategoryController extends Controller
{
    /**
     * @param CategoryRequest $request
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse|object
     */
    public function store(CategoryRequest $request, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->create($request->all());

        return (new CategoryResource($category))->response()->setStatusCode(201);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        if ($category->hasProducts()) return response()->json([
            'message' => 'Category can not be deleted'
        ], 403);

        $category->delete();

        return response()->json([], 204);
    }
}
