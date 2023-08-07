<?php

namespace App\Http\Controllers;

use App\Models\Audiencia;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Processo;
use Illuminate\Http\Request;

class AudienciasController extends Controller
{
    public function index()
    {
        $itens = Audiencia::orderBy('data_aud', 'desc')->paginate();
        return view('painel-adv.audiencias.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.audiencias.create');
    }

    public function insert(Request $request)
    {
        // Implementar lógica de inserção
    }

    public function edit(Audiencia $item)
    {
        return view('painel-adv.audiencias.edit', ['item' => $item]);
    }

    public function update(Request $request, Audiencia $item)
    {
        // Implementar lógica de atualização
    }

    public function delete(Audiencia $item)
    {
        $item->delete();
        return redirect()->route('audiencias.index');
    }

    public function modal($id)
    {
        $item = Audiencia::orderby('id', 'desc')->paginate();
        return view('painel-adv.audiencias.index', ['itens' => $item, 'id' => $id]);
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
