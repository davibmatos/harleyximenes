<?php

namespace App\Http\Controllers;

use App\Models\Audiencia;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Processo;
use Illuminate\Http\Request;

class AudienciasController extends Controller
{
    public function index($fonte = null)
    {
        $usuarioId = auth()->id();

        if ($fonte === 'advogado') {
            $itens = Processo::where('usuario_id', $usuarioId)->orderBy('data_aud', 'desc')->paginate();
        } else {
            $itens = Processo::orderBy('data_aud', 'desc')->paginate();
        }

        return view('painel-adv.audiencias.index', ['itens' => $itens]);
    }


    public function create()
    {
        return view('painel-adv.audiencias.create');
    }

    public function insert(Request $request)
    {
        $numeroProcesso = $request->numero_processo;
        $dataAud = $request->data_aud;
        $horaAud = $request->hora_aud;
        $tipoAud = $request->tipo_aud;
        $usuarioId = auth()->id(); // Obtém o ID do usuário logado

        $processoExistente = Processo::where('numero', $numeroProcesso)->first();
        dd($processoExistente);

        if ($processoExistente) {
            $processoExistente->data_aud = $dataAud;
            $processoExistente->hora_aud = $horaAud;
            $processoExistente->tipo_aud = $tipoAud;
            $processoExistente->save();
        } else {
            $novoProcesso = new Processo();
            $novoProcesso->numero = $numeroProcesso;
            $novoProcesso->usuario_id = $usuarioId;
            $novoProcesso->data_aud = $dataAud;
            $novoProcesso->hora_aud = $horaAud;
            $novoProcesso->tipo_aud = $tipoAud;
            $novoProcesso->save();
        }

        return redirect()->route('audiencias.index'); // Redireciona para a lista de audiências
    }


    public function edit(Audiencia $item)
    {
        return view('painel-adv.audiencias.edit', ['item' => $item]);
    }

    public function getAudienciaDetails(Request $request)
    {
        $numeroProcesso = $request->input('numero_processo');
        $processo = Processo::where('numero', $numeroProcesso)->first();

        if ($processo) {
            return response()->json(['data_aud' => $processo->data_aud, 'hora_aud' => $processo->hora_aud]);
        } else {
            return response()->json([], 404);
        }
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

    public function getCliente(Request $request)
    {
        $processo = Processo::find($request->processo_id);
        if ($processo) {
            return response()->json(['nome' => $processo->cliente->nome]);
        } else {
            return response()->json([], 404);
        }
    }
}
