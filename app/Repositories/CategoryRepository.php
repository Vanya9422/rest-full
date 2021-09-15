<?php

namespace App\Repositories;

use App\Models\Category;
use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
       return Category::class;
    }
}
