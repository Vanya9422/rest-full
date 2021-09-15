<?php

namespace App\Repositories;

use App\Http\Requests\Api\V1\ProductRequest;
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

    public function filterProducts(ProductRequest $request)
    {
        $this->newQuery();

        $name = $request->get('name');
        $category = $request->get('category');
        $categoryName = $request->get('categoryName');
        $priceFrom = $request->get('priceFrom');
        $priceTo = $request->get('priceTo');
        $withTrashed = $request->get('withTrashed');
        $published = $request->get('published');

        $this->query->with('categories');

        $this->query->when($name, function ($q) use ($name) {
            return $q->where('name', 'LIKE', "%$name%");
        });

        $this->query->when(($withTrashed && $withTrashed == 1), function ($q) {
            return $q->whereNull('deleted_at');
        });

        $this->query->when(($published == 1 || $published == 0), function ($q) use ($published) {
            return $q->where('published', $published);
        });

        $this->query->when(($priceFrom && !$priceTo), function ($q) use ($priceFrom) {
            return $q->where('price', '>=', $priceFrom);
        });

        $this->query->when((!$priceFrom && $priceTo), function ($q) use ($priceTo) {
            return $q->where('price', '<=', $priceTo);
        });

        $this->query->when(($priceFrom && $priceTo), function ($q) use ($priceFrom, $priceTo) {
            return $q->whereBetween('price', [$priceFrom, $priceTo]);
        });

        $this->query->when($category, function ($q) use ($category) {
            return $q->whereHas('categories', function ($q) use ($category) {
                $q->where('id', $category);
            });
        });

        $this->query->when($categoryName, function ($q) use ($categoryName) {
            return $q->whereHas('categories', function ($q) use ($categoryName) {
                $q->where('name', 'LIKE', "%$categoryName%");
            });
        });

        $this->query->when($categoryName, function ($q) use ($categoryName) {
            return $q->whereHas('categories', function ($q) use ($categoryName) {
                $q->where('name', 'LIKE', "%$categoryName%");
            });
        });

        return $this->query->get();
    }
}
