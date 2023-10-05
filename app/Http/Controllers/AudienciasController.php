<?php

namespace App\Http\Controllers;

use App\Models\Audiencia;
use App\Models\Processo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AudienciasController extends Controller
{
    public function index(Request $request, $fonte = null)
    {
        $usuarioId = Session::get('id_usuario');
        $dataInicio = $request->get('data_ini');  // Trocado para corresponder ao nome do campo no form
        $dataFim = $request->get('data_fim');  // Trocado para corresponder ao nome do campo no form
        $query = Processo::query();

        if ($dataInicio && $dataFim) {
            $dataIni = Carbon::createFromFormat('d/m/Y', $dataInicio)->startOfDay();
            $dataFim = Carbon::createFromFormat('d/m/Y', $dataFim)->endOfDay();
            $query->whereBetween('data_aud', [$dataIni, $dataFim]);
        }

        if ($fonte === 'advogado') {
            $query->whereHas('advogados', function ($q) use ($usuarioId) {
                $q->where('advogado_id', $usuarioId);
            });
        }

        $itens = $query->with(['advogados', 'usuarioCadastrante'])->orderBy('data_aud', 'desc')->paginate();

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


        $processoExistente = Processo::where('numero', $numeroProcesso)->first();

        if ($processoExistente) {
            $processoExistente->data_aud = $dataAud;
            $processoExistente->hora_aud = $horaAud;
            $processoExistente->tipo_aud = $tipoAud;
            $processoExistente->save();
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
        $processo = Processo::find($item->processo_id);

        if ($processo) {

            $processo->data_aud = null;
            $processo->hora_aud = null;

            $processo->save();
        }
        return redirect()->route('audiencias.index');
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
}
