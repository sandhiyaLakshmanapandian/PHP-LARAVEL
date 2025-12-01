<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * After user is authenticated, cache their role
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated($request, $user)
    {
        // Cache user role for 15 minutes
        Cache::put(
            'user_role_' . $user->id,
            $user->role->name ?? 'user',   // If no role found, store 'user'
            900                            // Cache for 900 seconds (15 minutes)
        );

        return redirect()->intended($this->redirectTo);
    }
}
