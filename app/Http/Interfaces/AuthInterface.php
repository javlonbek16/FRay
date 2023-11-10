<?php

namespace App\Http\Interfaces;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

interface AuthInterface
{
    function register(RegisterRequest $data);
    function login(Request $data);
}
