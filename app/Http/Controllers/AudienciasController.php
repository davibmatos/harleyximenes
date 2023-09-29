<?php

namespace App\Http\Controllers;

use App\Models\Audiencia;
use App\Models\Processo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AudienciasController extends Controller
{
    public function index(Request $request, $fonte = null)
    {
        $usuarioId = auth()->id();
        $dataInicio = $request->get('data_ini');  // Trocado para corresponder ao nome do campo no form
        $dataFim = $request->get('data_fim');  // Trocado para corresponder ao nome do campo no form
        $query = Processo::query();

        if ($dataInicio && $dataFim) {
            $dataIni = Carbon::createFromFormat('d/m/Y', $dataInicio)->startOfDay();
            $dataFim = Carbon::createFromFormat('d/m/Y', $dataFim)->endOfDay();
            $query->whereBetween('data_aud', [$dataIni, $dataFim]);
        }

        if ($fonte === 'advogado') {
            $query->where('usuario_id', $usuarioId);
        }

        $itens = $query->orderBy('data_aud', 'desc')->paginate();

        return view('painel-adv.audiencias.index', ['itens' => $itens]);
    }


    public function create()
    {
        return view('painel-adv.audiencias.create');
    }

    public function updateAudiencia(Request $request)
    {
        $id = $request->id_audiencia;
        $dataAud = $request->data_aud;
        $horaAud = $request->hora_aud;

        $processo = Processo::find($id);

        if ($processo) {
            $processo->data_aud = $dataAud;
            $processo->hora_aud = $horaAud;
            $processo->save();
            return redirect()->route('audiencias.index')->with('success', 'Data e hora atualizadas com sucesso.');
        } else {
            return redirect()->route('audiencias.index')->with('error', 'Processo não encontrado.');
        }
    }

    public function insert(Request $request)
    {

        $numeroProcesso = $request->numero_processo;
        $dataAud = $request->data_aud;
        $horaAud = $request->hora_aud;
        $tipoAud = $request->tipo_aud;
        $usuarioId = auth()->id(); // Obtém o ID do usuário logado

        $processoExistente = Processo::where('numero', $numeroProcesso)->first();

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
