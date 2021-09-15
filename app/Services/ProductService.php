<?php

namespace App\Services;

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
}
