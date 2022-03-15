<?php

namespace Database\Seeders;

use Database\Seeders\Account\UserTableSeeder;
use Database\Seeders\Product\ProductTableSeeder;
use Database\Seeders\Wallet\WalletTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(WalletTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
    }
}
