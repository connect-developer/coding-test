<?php

namespace App\Services;


use App\Core\Response\BasicResponse;
use App\Core\Response\GenericObjectResponse;
use App\Enums\HttpResponseType;
use App\Exceptions\ResponseInvalidLoginAttemptException;
use App\Exceptions\ResponseNotFoundException;
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
            if ($request->route('path') !== 'admin' &&
                $request->route('path') !== 'company') {
                throw new ResponseNotFoundException('Not found');
            }

            $identity = (filter_var($request->identity, FILTER_VALIDATE_EMAIL)) ? 'email' : 'username';

            if (!Auth::attempt([$identity => $request->identity, "password" => $request->password])) {
                throw new ResponseInvalidLoginAttemptException('Login invalid');
            }

            $user = Auth::user();
            $token = $user->createToken('token')->accessToken
                ->token;

            $response = $this->setGenericObjectResponse($response,
                ['token' => $token],
                'SUCCESS',
                HttpResponseType::SUCCESS);

            Log::info("User $user->id: Login succeed");
        } catch (ResponseNotFoundException $ex) {
            $response = $this->setMessageResponse($response,
                'ERROR',
                HttpResponseType::NOT_FOUND,
                $ex->getMessage());

            Log::error("Invalid api endpoint url", $response->getMessageResponseError());

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

    public function logout(string $email): BasicResponse
    {
        // TODO: Implement logout() method.
    }


}
