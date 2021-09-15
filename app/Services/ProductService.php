<?php

namespace App\Services;

use App\Http\Requests\Api\V1\ProductRequest;
use App\Models\Product;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * ProductService constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return ProductRepositoryInterface
     */
    public function getRepo(): ProductRepositoryInterface
    {
        return $this->productRepository;
    }

    /**
     * @return CategoryRepositoryInterface
     */
    public function category(): CategoryRepositoryInterface
    {
        return $this->categoryRepository;
    }

    /**
     * @param ProductRequest $request
     * @return mixed
     */
    public function createProduct(ProductRequest $request)
    {
        $product = $this->getRepo()->create($request->except('categories_ids'));
        $product->categories()->attach($request->get('categories_ids'));
        return $product;
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return mixed
     */
    public function updateProduct(ProductRequest $request, Product $product)
    {
        $product->categories()->sync($request->get('categories_ids'));
        $product->update($request->except(['categories_ids', 'id']));
        return $product;
    }
}
