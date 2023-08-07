<?php

namespace App\Http\Controllers;

use App\Models\Vara;
use Illuminate\Http\Request;

class VaraController extends Controller
{
    public function index()
    {
        $itens = Vara::orderBy('id', 'desc')->paginate();
        return view('painel-adm.varas.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adm.varas.create');
    }

    public function insert(Request $request)
    {
        $tabela = new Vara();
        $tabela->nome = $request->nome;
        $tabela->save();
        return redirect()->route('varas.index');
    }

    public function edit(Vara $item){
        return view('painel-adm.varas.edit', ['item' => $item]);   
     }
 
    public function update(Request $request, Vara $item)
    {
        $item->nome = $request->nome;
        $item->save();
        return redirect()->route('varas.index');
    }

    public function delete(Vara $item){
        $item->delete();
        return redirect()->route('varas.index');
     }

    public function modal($id){
        $item = Vara::orderby('id', 'desc')->paginate();
        return view('painel-adm.varas.index', ['itens' => $item, 'id' => $id]);
     } 
}
