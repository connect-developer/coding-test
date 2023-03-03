<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends ApiBaseController
{
    public function login(string $slug)
    {
        dd($slug);
//        if (Auth::guard('web')->attempt($request->only(['email', 'password']))) {
//            $request->session()->regenerate();
//
//            return new UserResource(Auth::user());
//        }
//
//        return response()->json([], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
