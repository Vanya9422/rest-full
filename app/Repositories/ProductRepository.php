<?php

namespace App\Repositories;

use App\Models\Product;
use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }
}
