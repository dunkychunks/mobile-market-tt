<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\PhpFlasher;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers, PhpFlasher;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $this->flashSuccess('Welcome back, ' . $user->name . '!');
    }

    protected function loggedOut(Request $request)
    {
        $this->flashInfo('You have been logged out.');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $this->flashError('Invalid email or password. Please try again.');

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
