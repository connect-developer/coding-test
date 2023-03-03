<?php

namespace App\Services\Contracts;

use App\Core\Response\GenericObjectResponse;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Http\Request;

interface IUserService
{
    public function register(RegisterRequest $request): GenericObjectResponse;

    public function userLogged(Request $request): GenericObjectResponse;
}
