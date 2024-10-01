<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show admin login form
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    // Handle admin login
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate using the 'admin' guard
        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin');
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // Override the default logout method to redirect based on user type
    public function logout(Request $request)
    {
        $redirectPath = auth()->guard('admin')->check() ? '/admin-login' : '/login';

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect($redirectPath);
    }


}
