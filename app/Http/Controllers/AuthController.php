<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authForm()
    {
        return view('authForm');
    }

    public function auth(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($request->password == $user->password)
        {
            Auth::login($user);
            $request->session()->regenerate();
            return view('index');
        }
        else
        {
            dd('Что-то не так');
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
