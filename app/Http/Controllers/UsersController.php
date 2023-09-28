<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->usuario;
        $senha = $request->senha;
        $novaSenha = $request->nova_senha;

        $usuarios = Usuario::where('usuario', '=', $usuario)->first();

        if ($usuarios && $senha == $usuarios->senha) {
            if ($usuarios->primeiro_acesso) {
                if ($novaSenha) {
                    $usuarios->senha = $novaSenha;
                    $usuarios->primeiro_acesso = 0;
                    $usuarios->save();
                } else {
                    return redirect()->route('login')->with('primeiro_acesso', true);
                }
            }

            Session::put('id_usuario', $usuarios->id);
            Session::put('usuario', $usuarios->usuario);
            Session::put('nivel_usuario', $usuarios->nivel);
            Session::put('cpf_usuario', $usuarios->cpf);

            switch (Session::get('nivel_usuario')) {
                case 'admin':
                    return redirect()->route('painel-adv.prazos.index');
                case 'adv':
                    return redirect()->route('painel-adv.prazos.index');
                case 'estagiario':
                    return view('painel-user.index');
                default:
                    Session::flush();
                    return redirect()->route('login')->with('error', 'Nível de usuário não reconhecido.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Dados Incorretos!');
        }
    }

    public function atualizarSenha(Request $request)
    {
        $id = Session::get('id_usuario');
        $novaSenha = $request->nova_senha;

        $usuario = Usuario::find($id);
        $usuario->senha = $novaSenha; // considere usar hash aqui
        $usuario->primeiro_acesso = false;
        $usuario->save();

        return redirect()->route('painel-adv.prazos.index');
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
