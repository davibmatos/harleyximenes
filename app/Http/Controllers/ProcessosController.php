<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\Comarca;
use App\Models\Processo;
use App\Models\usuario;
use App\Models\Vara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProcessosController extends Controller
{
    public function index()
    {
        $itens = Processo::with(['cliente', 'empresa', 'vara', 'comarca', 'usuario'])->orderBy('id', 'desc')->paginate();

        return view('painel-adv.processos.index', ['itens' => $itens]);
    }

    public function audiencias()
    {
        $itens = Processo::with(['cliente', 'empresa', 'vara', 'comarca'])
            ->orderBy('data_aud', 'desc')
            ->paginate();

        return view('painel-adv.audiencias.index', ['itens' => $itens]);
    }

    public function create()
    {
        $comarcas = Comarca::all();
        $advogados = usuario::all();
        return view('painel-adv.processos.create', compact('comarcas', 'advogados'));
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
        $tabela->cliente_id = $request->cliente_id;
        $tabela->empresa_id = $request->empresa_id;
        $tabela->comarca_id = $request->comarca_id;
        $tabela->data_aud = $request->data_aud;
        $tabela->hora_aud = $request->hora_aud;
        $tabela->tipo_aud = $request->tipo_aud;
        $tabela->adv_id = $request->adv_id;
        dd($tabela);

        $tabela->save();

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

        return redirect()->route('processos.index');
    }

    public function edit(Processo $item)
    {
        $comarcas = Comarca::all();
        $varas = Vara::all();
        return view('painel-adv.processos.edit', ['item' => $item], compact('comarcas', 'varas'));
    }

    public function update(Request $request, Processo $item)
    {
        $item->numero = $request->numero;
        $item->usuario_id = $request->usuario_id;
        $item->vara_id = $request->vara_id;
        $item->empresa_id = $request->empresa_id;
        $item->cliente_id = $request->cliente_id;
        $item->comarca_id = $request->comarca_id;
        $item->data_aud = $request->data_aud;
        $item->hora_aud = $request->hora_aud;
        $item->tipo_aud = $request->tipo_aud;

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
        $numeroProcesso = $request->input('numero_processo');
        $processo = Processo::where('numero', $numeroProcesso)->first();

        if ($processo) {
            return response()->json(['nome' => $processo->cliente->nome]);
        } else {
            return response()->json([], 404);
        }
    }

    public function getVaras(Request $request)
    {
        $comarcaId = $request->get('comarca_id');
        $varas = Vara::where('comarca_id', $comarcaId)->get();
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
