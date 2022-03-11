<?php

namespace App\Domains\Account;

use App\Domains\Core\Repository;
use App\Models\Account\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function newModel()
    {
        return new User();
    }

    public function fill(array $data, Model $model)
    {
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->password = bcrypt($data['password']);
        return $model;
    }
}
