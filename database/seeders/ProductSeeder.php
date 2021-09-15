<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ProductSeeder extends Seeder
{
    public function run()
    {
        if (App::environment('local')) {

            $ids = range(1, 50);

            Product::factory()->count(500)->create()
                ->each(function ($product) use ($ids) {
                    $ids = $this->array_random($ids, rand(2, 10));
                    $product->categories()->attach($ids);
                });
        }
    }

    function array_random($array, $amount = 1)
    {
        $keys = array_rand($array, $amount);

        if ($amount == 1) {
            return $array[$keys];
        }

        $results = [];
        foreach ($keys as $key) {
            $results[] = $array[$key];
        }

        return $results;
    }
}
