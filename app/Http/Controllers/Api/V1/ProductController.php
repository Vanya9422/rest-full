<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ProductRequest;
use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;
use App\Services\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * @var ProductServiceInterface
     */
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductServiceInterface $productService
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse|ProductResource
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::transaction(function () use (&$product, $request) {
                $product = $this->productService->createProduct($request);
            });

            return (new ProductResource($product));
        } catch (\Exception $e) {
           return response()->json([
                'message' => 'в системе произошла внутренняя ошибка'
            ], 400);
        }
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return ProductResource|JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use (&$product, $request) {
                $product = $this->productService->updateProduct($request, $product);
            });

            return (new ProductResource($product));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'в системе произошла внутренняя ошибка'
            ], 400);
        }
    }

    public function destroy(Product $product)
    {
        //
    }
}
