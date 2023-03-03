<?php

namespace App\Services;

use App\Core\Response\GenericObjectResponse;
use App\Enums\HttpResponseType;
use App\Exceptions\ResponseNotFoundException;
use App\Http\Requests\User\RegisterRequest;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IUserService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService implements IUserService
{
    public IUserRepository $_userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): GenericObjectResponse
    {
        $response = new GenericObjectResponse();

        try {
            DB::beginTransaction();

            $register = $this->_userRepository->register($request);

            DB::commit();

            $response = $this->setGenericObjectResponse($response,
                $register,
                'SUCCESS',
                HttpResponseType::SUCCESS);

            Log::info("User register success");

        } catch (QueryException $ex) {
            DB::rollBack();

            $response = $this->setMessageResponse($response,
                'ERROR',
                HttpResponseType::BAD_REQUEST,
                $ex->getMessage());

            Log::error("Invalid validation", $response->getMessageResponseError());

        } catch (Exception $ex) {
            DB::rollBack();

            $response = $this->setMessageResponse($response,
                'ERROR',
                HttpResponseType::INTERNAL_SERVER_ERROR,
                $ex->getMessage());

            Log::error("Invalid register", $response->getMessageResponseError());
        }

        return $response;
    }
}
