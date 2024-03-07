<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login',
        ]);
    }


    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo());
        }

        return back()->with('loginError', 'Login failled');
    }

    protected function redirectTo()
    {
        if (auth()->user()->role === 'admin') {
            return '/dashboard';
        } elseif (auth()->user()->role === 'user') {
            return '/user/dashboard';
        } else {
            // Redirect default jika tidak memiliki peran yang valid
            return '/';
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
