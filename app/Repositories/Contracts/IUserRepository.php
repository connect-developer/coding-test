<?php

namespace App\Repositories\Contracts;

use App\Core\Entity\BaseEntity;
use App\Http\Requests\User\RegisterRequest;

interface IUserRepository
{
    public function register(RegisterRequest $request): BaseEntity;
}
