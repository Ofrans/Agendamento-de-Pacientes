<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showFormLogin() {
        return view('login');
    }

    public function login (Request $request) {
        $credenciais = $request->only('email', 'password');
        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->intended('/agendamentos');
        }
        return back()->withErrors([
            'login' => 'Credenciais inválidas!'
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
