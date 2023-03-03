<?php

namespace App\Services\Contracts;

use App\Core\Response\BasicResponse;
use App\Core\Response\GenericObjectResponse;
use App\Http\Requests\Auth\LoginRequest;

interface IAuthService
{
    public function login(LoginRequest $request): GenericObjectResponse;

    public function logout(): BasicResponse;
}
