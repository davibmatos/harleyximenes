<?php

namespace App\Http\Controllers;

use App\Models\Comarcas;
use Illuminate\Http\Request;

class ComarcaController extends Controller
{
    public function index()
    {
        $itens = Comarcas::orderBy('id', 'desc')->paginate();
        return view('painel-adm.comarcas.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adm.comarcas.create');
    }

    public function insert(Request $request)
    {
        $tabela = new Comarcas();
        $tabela->nome = $request->nome;
        $tabela->save();
        return redirect()->route('comarcas.index');
    }

    public function edit(Comarcas $item){
        return view('painel-adm.comarcas.edit', ['item' => $item]);   
     }
 
    public function update(Request $request, Comarcas $item)
    {
        $item->nome = $request->nome;
        $item->save();
        return redirect()->route('comarcas.index');
    }

    public function delete(Comarcas $item){
        $item->delete();
        return redirect()->route('comarcas.index');
     }

    public function modal($id){
        $item = Comarcas::orderby('id', 'desc')->paginate();
        return view('painel-adm.comarcas.index', ['itens' => $item, 'id' => $id]);
     } 
}
