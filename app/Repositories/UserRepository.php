<?php

namespace App\Repositories;

use App\Core\Entity\BaseEntity;
use App\Http\Requests\User\RegisterRequest;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Contracts\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public User $_user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->_user = $user;
    }

    public function register(RegisterRequest $request): BaseEntity
    {
        $user = new $this->_user([
            "email" => $request->email,
            "username" => $request->username,
            "role" => ($request->route('path') === 'company') ? "COMPANY" : "ADMIN",
            "password" => bcrypt($request->password)
        ]);

        $this->setAuditableInformationFromRequest($user, $request);

        $user->save();

        if ($request->route('path') === 'company') {
            $user->company()->save(new Company([
                "name" => $request->company_name
            ]));
        }

        return $user->fresh();
    }
}
