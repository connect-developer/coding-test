<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\UserResource;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;

class UserController extends ApiBaseController
{
    public IUserService $_userService;

    public function __construct(IUserService $userService)
    {
        $this->_userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $registerResponse = $this->_userService->register($request);

        if ($registerResponse->isError()) {
            return $this->getErrorJsonResponse($registerResponse);
        }

        return $this->getObjectJsonResponse($registerResponse, RegisterResource::class);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
}
