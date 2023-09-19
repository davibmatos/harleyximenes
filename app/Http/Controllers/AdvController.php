<?php

namespace App\Http\Controllers;

use App\Models\advogados;
use App\Models\usuario;
use App\Models\usuarios;
use Illuminate\Http\Request;

class AdvController extends Controller
{
    public function index()
    {
        $tabela = advogados::orderBy('id', 'desc')->paginate();
        return view('painel-adm.advogados.index', ['itens' => $tabela]);
    }

    public function create()
    {
        return view('painel-adm.advogados.create');
    }

    public function insert(Request $request)
    {
        
        $tabela = new advogados();
        $tabela->nome = $request->nome;
        $tabela->email = $request->email;
        $tabela->cpf = $request->cpf;
        $tabela->telefone = $request->telefone;
        $tabela->credencial = $request->credencial;
        $tabela->data = $request->data;

        $tabela2 = new usuario();
        $tabela2->nome = $request->nome;
        $tabela2->email = $request->email;
        $tabela2->cpf = $request->cpf;
        $tabela2->telefone = $request->telefone;
        $tabela2->senha = $request->cpf;
        $tabela2->nivel = 'sindico';

        $itens = advogados::where('cpf', '=', $request->cpf)->orwhere('email', '=', $request->email)->first();

        if ($itens !== null) {
            echo "<script language='javascript'> window.alert('O Advogado cadastrado já existe') </script>";
            return view('painel-adm.advogados.create');
        }

        $tabela->save();
        $tabela2->save();
        return redirect()->route('advogados.index');
    }

    public function edit(advogados $item){
        return view('painel-adm.advogados.edit', ['item' => $item]);   
     }
 
 
     public function editar(Request $request, advogados $item){
         
        $item->nome = $request->nome;
        $item->email = $request->email;
        $item->cpf = $request->cpf;
        $item->telefone = $request->telefone;
        $item->credencial = $request->credencial;
        $item->data = $request->data;
       

        $oldcpf = $request->oldcpf;
        $oldemail = $request->oldemail;
        $oldcredencial = $request->oldcredencial;

        if($oldcpf != $request->cpf){
            $itens = advogados::where('cpf', '=', $request->cpf)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('CPF já Cadastrado!') </script>";
                return view('painel-adm.advogados.edit', ['item' => $item]);   
                
            }
        }

        if($oldcredencial != $request->credencial){
            $itens = advogados::where('credencial', '=', $request->credencial)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('Credencial já Cadastrada!') </script>";
                return view('painel-adm.advogados.edit', ['item' => $item]);   
                
            }
        }


        if($oldemail != $request->email){
            $itens = advogados::where('email', '=', $request->email)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('Email já Cadastrado!') </script>";
                return view('painel-adm.advogados.edit', ['item' => $item]);   
                
            }
        }     

        $item->save();
         return redirect()->route('advogados.index');
 
     }

     public function delete(advogados $item){
        $item->delete();
        return redirect()->route('advogados.index');
     }

     public function modal($id){
        $item = advogados::orderby('id', 'desc')->paginate();
        return view('painel-adm.sindicos.index', ['itens' => $item, 'id' => $id]);
     } 
}
