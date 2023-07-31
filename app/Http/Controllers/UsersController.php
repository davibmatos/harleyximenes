<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->usuario;
        $senha = $request->senha;

        $usuarios = usuarios::where('usuario', '=', $usuario)->where('senha', '=', $senha)->first();

        if (@$usuarios->id != null) {
            @session_start();
            $_SESSION['id_usuario'] = $usuarios->id;
            $_SESSION['usuario'] = $usuarios->usuario;
            $_SESSION['nivel_usuario'] = $usuarios->nivel;
            $_SESSION['cpf_usuario'] = $usuarios->cpf;

            if ($_SESSION['nivel_usuario'] == 'admin') {
                return redirect()->route('admin.index');
            }
            if ($_SESSION['nivel_usuario'] == 'advogado') {
                return view('painel-sindico.index');
            }
            if ($_SESSION['nivel_usuario'] == 'estagiario') {
                return view('painel-user.index');
            }
        } else {
            echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
            return view('index');
        }
    }
    public function logout()
    {
        @session_start();
        @session_destroy();
        return view('index');
    }
}

