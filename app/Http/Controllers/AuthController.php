<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
   
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records'
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);

        Account::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('login');
    }
}
