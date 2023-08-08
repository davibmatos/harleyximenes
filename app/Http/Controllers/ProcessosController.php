<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\Processo;
use App\Models\Comarcas;
use App\Models\Varas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcessosController extends Controller
{
    public function index()
    {
        $itens = Processo::orderBy('id', 'desc')->paginate();
        return view('painel-adv.processos.index', ['itens' => $itens]);
    }

    public function create()
    {
        $comarcas = Comarcas::all();
        return view('painel-adv.processos.create', compact('comarcas'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'anexos.*' => 'max:10240'
        ], [
            'anexos.*.max' => 'O tamanho do arquivo não deve exceder 10MB.'
        ]);

        $tabela = new Processo();
        $tabela->numero = $request->numero;
        $tabela->usuario_id = $request->usuario_id;
        $tabela->vara_id = $request->vara_id;
        $tabela->empresa_id = $request->empresa_id;
        $tabela->cliente_id = $request->cliente_id;
        $tabela->comarca_id = $request->comarca_id;

        if ($request->hasFile('anexos')) {
            foreach ($request->file('anexos') as $file) {
                $nome = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('anexos', $nome, 'public');

                // Salva na tabela de anexos
                $anexo = new Anexo();
                $anexo->processo_id = $tabela->id;
                $anexo->arquivo = $nome;
                $anexo->save();
            }
        }

        $tabela->save();
        return redirect()->route('processos.index');
    }

    public function edit(Processo $item)
    {
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

        if ($request->hasFile('anexos')) {
            foreach ($request->file('anexos') as $anexo) {
                $anexoPath = $anexo->store('anexos', 'public');
                $item->anexos()->create(['caminho_arquivo' => $anexoPath]);
            }
        }

        $item->save();
        return redirect()->route('processos.index');
    }

    public function delete(Processo $item)
    {
        $item->delete();
        return redirect()->route('processos.index');
    }

    public function modal($id)
    {
        $item = Processo::orderby('id', 'desc')->paginate();
        return view('painel-adv.processos.index', ['itens' => $item, 'id' => $id]);
    }

    public function getCliente(Request $request)
    {
        $processo = Processo::find($request->processo_id);
        if ($processo) {
            return response()->json(['nome' => $processo->cliente->nome]);
        } else {
            return response()->json([], 404);
        }
    }

    public function getVaras(Request $request)
    {
        $comarcaId = $request->get('comarca_id');
        $varas = Varas::where('comarca_id', $comarcaId)->get();
        if ($varas->isEmpty()) {
            return response()->json(['message' => 'Nenhuma vara encontrada'], 404);
        }
        return response()->json($varas);
    }

    public function deleteAnexo(Processo $processo, Anexo $anexo)
    {
        if ($anexo->processo_id !== $processo->id) {
            return abort(404);
        }

        Storage::disk('public')->delete($anexo->caminho_arquivo);
        $anexo->delete();

        return back()->with('success', 'Anexo deletado com sucesso!');
    }
}
