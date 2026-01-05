<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function showSingnupForm()
    {


        return view('auth.signup', ['pageTitle' => 'signup']);
    }

    public function Signup(SignupRequest $request)
    {

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        auth()->guard('web')->login($user);

        return redirect('/');

    }

    public function showLoginForm()
    {

        return view('auth.login', ['pageTitle' => 'Login']);
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (auth()->guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();

    }

    public function logout()
    {

        auth()->guard('web')->logout();

        return redirect('/');
    }

}