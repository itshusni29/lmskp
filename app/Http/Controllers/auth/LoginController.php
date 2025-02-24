<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:8',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();

            // Redirect based on role
            $role = Auth::user()->role;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'trainer') {
                return redirect()->route('trainer.dashboard');
            } elseif ($role === 'manager') {
                return redirect()->route('manager.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        }

        // Logging for debugging
        \Log::info('Login failed for username: ' . $request->username);

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
