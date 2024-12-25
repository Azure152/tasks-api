<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $authenticated = $request->authenticate();

        if ($authenticated) {
            return null;
        }

        throw ValidationException::withMessages([
            'email' => ['bad credentials']
        ]);
    }
}
