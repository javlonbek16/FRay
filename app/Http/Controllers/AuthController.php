<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthInterface $authRepository)
    {
    }

    public function register(RegisterRequest $request)
    {
        return $this->authRepository->register($request);
    }
    public function login(Request $request)
    {
        return $this->authRepository->login($request);
    }
}
