<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login.index');
    }

    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('failed', 'Incorrect email or password.');
        } elseif (!$user->is_active) {
            return back()->with('failed', 'Your account has been deactivated.');
        } elseif (Auth::attempt(['email' => $email, 'password' => $password,])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        } else {
            return back()->with('failed', 'Incorrect email or password.');
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
