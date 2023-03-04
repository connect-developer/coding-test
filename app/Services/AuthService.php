<?php

namespace App\Services;


use App\Core\Response\BasicResponse;
use App\Core\Response\GenericObjectResponse;
use App\Enums\HttpResponseType;
use App\Exceptions\ResponseInvalidLoginAttemptException;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService extends BaseService implements IAuthService
{
    public IUserRepository $_userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    public function login(LoginRequest $request): GenericObjectResponse
    {
        $response = new GenericObjectResponse();

        try {
            $identity = (filter_var($request->identity, FILTER_VALIDATE_EMAIL)) ? 'email' : 'username';

            if (!Auth::attempt([$identity => $request->identity, "password" => $request->password])) {
                throw new ResponseInvalidLoginAttemptException('Login invalid');
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            $response = $this->setGenericObjectResponse($response,
                ['email' => $user->email, 'role' => $user->role, 'access_token' => $token, 'token_type' => 'Bearer'],
                'SUCCESS',
                HttpResponseType::SUCCESS);

            Log::info("User $user->id: Login succeed");
        } catch (ResponseInvalidLoginAttemptException $ex) {
            $response = $this->setMessageResponse($response,
                "INFO",
                HttpResponseType::UNAUTHORIZED,
                $ex->getMessage());

            Log::error("Invalid login attempt", [$response->getMessageResponseError()]);
        } catch (\Exception $ex) {
            $response = $this->setMessageResponse($response,
                'ERROR',
                HttpResponseType::UNAUTHORIZED,
                $ex->getMessage());

            Log::error("Invalid login", [$response->getMessageResponseError()]);
        }

        return $response;
    }

    public function logout(): BasicResponse
    {
        $response = new BasicResponse();

        try {
            $userId = Auth::user()->id;
            Auth::user()->tokens()->delete();

            $response = $this->setMessageResponse($response,
                'SUCCESS',
                HttpResponseType::SUCCESS,
                'Logout succeed');

            Log::info("User $userId: Logout succeed");
        } catch (\Exception $ex) {
            $response = $this->setMessageResponse($response,
                'ERROR',
                HttpResponseType::INTERNAL_SERVER_ERROR,
                $ex->getMessage());

            Log::error("Invalid logout", $response->getMessageResponseError());
        }

        return $response;
    }

}
