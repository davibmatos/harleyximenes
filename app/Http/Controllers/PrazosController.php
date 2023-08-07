<?php

namespace App\Http\Controllers;

use App\Models\Prazo;
use Illuminate\Http\Request;

class PrazosController extends Controller
{
    public function index()
    {
        $itens = Prazo::orderBy('id', 'desc')->paginate();
        return view('painel-adv.prazos.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.prazos.create');
    }

    public function insert(Request $request)
    {
        $tabela = new Prazo();
        $tabela->processo_id = $request->processo_id;
        $tabela->data_ini = $request->data_ini;
        $tabela->data_fim = $request->data_fim;
        $tabela->save();
        return redirect()->route('prazos.index');
    }

    public function edit(Prazo $item){
        return view('painel-adv.prazos.edit', ['item' => $item]);   
     }
 
    public function update(Request $request, Prazo $item)
    {
        $item->processo_id = $request->processo_id;
        $item->data_ini = $request->data_ini;
        $item->data_fim = $request->data_fim;
        $item->save();
        return redirect()->route('prazos.index');
    }

    public function delete(Prazo $item){
        $item->delete();
        return redirect()->route('prazos.index');
     }

    public function modal($id){
        $item = Prazo::orderby('id', 'desc')->paginate();
        return view('painel-adv.prazos.index', ['itens' => $item, 'id' => $id]);
     } 
}
