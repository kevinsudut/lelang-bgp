<?php

namespace Database\Seeders\Account;

use App\Domains\Account\UserRepository;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    private $repository;

    public function __construct(UserRepository $repository)
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
        $data = [
            [
                'name' => 'User 1',
                'email' => 'user1@testing.com',
                'password' => 'user1',
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@testing.com',
                'password' => 'user2',
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@testing.com',
                'password' => 'user3',
            ],
        ];

        foreach ($data as $datum) {
            $this->repository->insert($datum);
        }
    }
}
