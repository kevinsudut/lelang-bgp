<?php

namespace Database\Seeders\Product;

use App\Domains\Product\ProductRepository;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $data = [
                    'user_id' => rand(1, 3),
                    'name' => "Product $i",
                    'description' => 'Description',
                    'image' => 'product/tokopedia.jpg',
                    'start_time' => Carbon::now()->addDays(rand(-1, 4)),
                    'end_time' => Carbon::now()->addDays(rand(5, 10)),
                    'start_bid' => rand(100, 10000) * 100,
                    'minimum_bid' => rand(0, 100) * 100
            ];

            $this->repository->insert($data);
        }
    }
}
