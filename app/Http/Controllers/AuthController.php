<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        //dd($request->password);
        if ($request->password == $user->password)
        {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect(route('users.index'));
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
