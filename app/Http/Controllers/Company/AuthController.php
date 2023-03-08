<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Company\Traits\AuthLoginTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthLoginTrait;
}
