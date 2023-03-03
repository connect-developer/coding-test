<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Contracts\IAuthService;

class LoginController extends ApiBaseController
{
    public IAuthService $_authService;

    public function __construct(IAuthService $authService)
    {
        $this->_authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $loginResponse = $this->_authService->login($request);

        if ($loginResponse->isError()) {
            return $this->getErrorJsonResponse($loginResponse);
        }

        if ($loginResponse->isInfo()) {
            return $this->getInfoJsonResponse($loginResponse);
        }

        return $this->getObjectJsonResponse($loginResponse);
    }

    public function logout()
    {
        $logoutResponse = $this->_authService->logout();

        if ($logoutResponse->isError()) {
            return $this->getErrorJsonResponse($logoutResponse);
        }

        return $this->getSuccessLatestJsonResponse($logoutResponse);
    }
}
