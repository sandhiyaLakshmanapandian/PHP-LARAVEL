<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/index.html'; // FIXED

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // generate token
        $token = Str::random(60);

        // update in DB
        $user->update([
            'remember_token' => $token
        ]);

        // store in session
        session(['auth_token' => $token]);

        // store blog count
        $request->session()->put('blog_count', $user->blogs()->count());
    }
}
