<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->usuario;
        $senha = $request->senha;

        $usuarios = Usuario::where('usuario', '=', $usuario)->first();

        // Comparação direta da senha
        if ($usuarios && $senha == $usuarios->senha) {
            Session::put('id_usuario', $usuarios->id);
            Session::put('usuario', $usuarios->usuario);
            Session::put('nivel_usuario', $usuarios->nivel);
            Session::put('cpf_usuario', $usuarios->cpf);

            switch (Session::get('nivel_usuario')) {
                case 'admin':
                    return redirect()->route('painel-adv.prazos.index');
                case 'advogado':
                    return view('painel-sindico.index');
                case 'estagiario':
                    return view('painel-user.index');
                default:
                    Session::flush(); // limpe a sessão para evitar problemas
                    return redirect()->route('login')->with('error', 'Nível de usuário não reconhecido.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Dados Incorretos!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('index');
    }
}
