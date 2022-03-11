<?php

namespace App\Http\Controllers\Account;

use App\Domains\Account\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\LoginRequest;
use App\Http\Requests\Account\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ], $request->get('remember') == 'on')) {
            return redirect('/');
        }

        return redirect()->back()->withErrors('Invalid email or password');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->userRepository->insert([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        return redirect('auth/login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/auth/login');
    }
}
