<?php

namespace Database\Seeders\Wallet;

use App\Domains\Wallet\WalletRepository;
use Illuminate\Database\Seeder;

class WalletTableSeeder extends Seeder
{
    private $repository;

    public function __construct(WalletRepository $repository)
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
        for ($i = 1; $i <= 3; $i++) {
            $this->repository->insert([
                'user_id' => $i,
                'amount' => rand(100000, 10000000),
            ]);
        }
    }
}
