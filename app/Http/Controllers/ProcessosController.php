<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use Illuminate\Http\Request;

class ProcessosController extends Controller
{
    public function index()
    {
        $itens = Processo::orderBy('id', 'desc')->paginate();
        return view('painel-adv.processos.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.processos.create');
    }

    public function insert(Request $request)
    {
        $tabela = new Processo();
        $tabela->numero = $request->numero;
        $tabela->usuario_id = $request->usuario_id;
        $tabela->vara_id = $request->vara_id;
        $tabela->empresa_id = $request->empresa_id;
        $tabela->cliente_id = $request->cliente_id;
        $tabela->comarca_id = $request->comarca_id;
        $tabela->save();
        return redirect()->route('processos.index');
    }

    public function edit(Processo $item){
        return view('painel-adv.processos.edit', ['item' => $item]);   
     }
 
    public function update(Request $request, Processo $item)
    {
        $item->numero = $request->numero;
        $item->usuario_id = $request->usuario_id;
        $item->vara_id = $request->vara_id;
        $item->empresa_id = $request->empresa_id;
        $item->cliente_id = $request->cliente_id;
        $item->comarca_id = $request->comarca_id;
        $item->save();
        return redirect()->route('processos.index');
    }

    public function delete(Processo $item){
        $item->delete();
        return redirect()->route('processos.index');
     }

    public function modal($id){
        $item = Processo::orderby('id', 'desc')->paginate();
        return view('painel-adv.processos.index', ['itens' => $item, 'id' => $id]);
     } 

     public function getCliente(Request $request) {
        $processo = Processo::find($request->processo_id);
        if ($processo) {
            return response()->json(['nome' => $processo->cliente->nome]);
        } else {
            return response()->json([], 404);
        }
    }
}
