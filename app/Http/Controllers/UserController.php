<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function create() {
        return view("users.create");
    }

    public function store(Request $request) {
        try {
            $dados = $request->all();
            $dados['password'] = Hash::make($dados['password']);
            User::create($dados);
            return redirect('/login');
        } catch(Exception $e) {
            Log::error("Erro ao criar o usuário: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect('/cadastro')->with('erro', 'Erro ao cadastrar!');
        }
    }

    public function edit() {
        return view('users.edit');
    }

    public function update(Request $request) {
        try {
            $user = Auth::user();
            if (!Hash::check($request->input('confirm-password'), $user->password)) {
                return redirect('/editar')->with('erro', 'A senha anterior não confere!');
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            Auth::logout();
            return redirect('/login');
        } catch(Exception $e) {
            Log::error("Erro ao criar o usuário: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect('/cadastro')->with('erro', 'Erro ao cadastrar!');
        }
    }
}
