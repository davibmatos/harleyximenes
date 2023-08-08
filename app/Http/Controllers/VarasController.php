<?php

namespace App\Http\Controllers;

use App\Models\Varas;
use Illuminate\Http\Request;

class VarasController extends Controller
{
    public function index()
    {
        $itens = Varas::orderBy('id', 'desc')->paginate();
        return view('painel-adv.varas.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.varas.create');
    }

    public function insert(Request $request)
    {
        $tabela = new Varas();
        $tabela->nome = $request->nome;
        $tabela->save();
        return redirect()->route('varas.index');
    }

    public function edit(Varas $item){
        return view('painel-adm.varas.edit', ['item' => $item]);   
     }
 
    public function update(Request $request, Varas $item)
    {
        $item->nome = $request->nome;
        $item->save();
        return redirect()->route('varas.index');
    }

    public function delete(Varas $item){
        $item->delete();
        return redirect()->route('varas.index');
     }

    public function modal($id){
        $item = Varas::orderby('id', 'desc')->paginate();
        return view('painel-adv.varas.index', ['itens' => $item, 'id' => $id]);
     } 
}
