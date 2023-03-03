<?php

namespace App\Services\Contracts;

use App\Core\Response\GenericObjectResponse;
use App\Http\Requests\User\RegisterRequest;

interface IUserService
{
    public function register(RegisterRequest $request): GenericObjectResponse;
}
