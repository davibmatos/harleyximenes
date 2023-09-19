<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function index()
    {
        $itens = Empresa::orderBy('id', 'desc')->paginate();
        return view('painel-adv.empresas.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.empresas.create');
    }

    public function insert(Request $request)
    {
        $tabela = new Empresa();
        $tabela->nome = $request->nome;
        $tabela->cnpj = $request->cnpj;
        $tabela->telefone = $request->telefone;
        $tabela->telefone2 = $request->telefone2;
        $tabela->email = $request->email;
        $tabela->endereco = $request->endereco;
        $tabela->preposto = $request->preposto;
        $tabela->save();
        return redirect()->route('empresas.index');
    }

    public function edit(Empresa $item)
    {
        return view('painel-adv.empresas.edit', ['item' => $item]);
    }

    public function update(Request $request, Empresa $item)
    {
        $item->nome = $request->nome;
        $item->cnpj = $request->cnpj;
        $item->telefone = $request->telefone;
        $item->telefone2 = $request->telefone2;
        $item->email = $request->email;
        $item->save();
        return redirect()->route('empresas.index');
    }

    public function delete(Empresa $item)
    {
        $item->delete();
        return redirect()->route('empresas.index');
    }

    public function modal($id)
    {
        $item = Empresa::orderby('id', 'desc')->paginate();
        return view('painel-adm.empresas.index', ['itens' => $item, 'id' => $id]);
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $empresas = Empresa::where('cnpj', 'like', "%{$q}%")->paginate();

        return response()->json($empresas);
    }

    public function searchByCnpj(Request $request)
    {
        $cnpj = $request->get('cnpj');
        $empresa = Empresa::where('cnpj', $cnpj)->first();
        return response()->json($empresa);
    }
}
