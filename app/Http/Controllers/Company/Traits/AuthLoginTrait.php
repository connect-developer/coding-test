<?php

namespace App\Http\Controllers\Company\Traits;

use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuthLoginTrait {
    public function login(Request $request)
    {
        $this->validated($request);

        if ($this->guard()->attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            return new AdminResource(Auth::user());
        }

        return response()->json([], 401);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function validated(Request $request)
    {
        return $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
    }

    /**
     * @return Auth
     */

    public function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }
}