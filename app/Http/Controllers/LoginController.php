<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('web')->attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            return new AdminResource(Auth::user());
        }

        return response()->json([], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return response()->noContent();
    }
}
