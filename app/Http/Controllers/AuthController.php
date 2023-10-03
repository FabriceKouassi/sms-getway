<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $pIndex = 'login';

        $param = [
            'pIndex' => $pIndex
        ];

        return view('Auth.login', $param);
    }

    public function loginUser(LoginRequest $request)
    {
        $data = $request->validated();

        // Tentez de connecter l'utilisateur
        if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('dashboard');
        } else {
            return back()->withInput()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
        }
    }

    public function showRegisterForm()
    {
        $pIndex = 'register';

        $param = [
            'pIndex' => $pIndex
        ];

        return view('Auth.register', $param);
    }

    public function registerUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('page.login');
    }

}
