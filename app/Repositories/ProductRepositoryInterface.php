<?php

namespace App\Repositories;

use App\Http\Requests\Api\V1\ProductRequest;
use NamTran\LaravelMakeRepositoryService\Repository\RepositoryContract;

/**
 * Interface ProductRepositoryInterface
 * @package App\Repositories
 */
interface ProductRepositoryInterface extends RepositoryContract
{
    /**
     * @param ProductRequest $request
     * @return mixed
     */
    public function filterProducts(ProductRequest $request);
}
