<?php

namespace App\Http\Controllers;

use App\Models\Prazo;
use App\Models\Processo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class PrazosController extends Controller
{
    public function index()
    {
        $usuario_id = Session::get('id_usuario'); // Pega o ID do usuário logado
        $itens = Prazo::with('processo')
            ->where('usuario_id', $usuario_id)
            ->orderBy('id', 'desc')
            ->paginate();
        return view('painel-adv.prazos.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.prazos.create');
    }

    public function insert(Request $request)
    {
        // Verifica se o usuário está logado
        if (!$request->has('usuario_id') || is_null($request->usuario_id)) {
            return redirect()->route('login')->with('error', 'Sua sessão expirou. Por favor, faça login novamente.');
        }

        // Verifica se o número do processo já existe no sistema
        $processo = Processo::where('numero', $request->numero)->first();
        if (!$processo) {
            return redirect()->back()->withInput()->with('error', 'Número de processo não existe no sistema!');
        }

        // Se tudo estiver ok, insere o novo prazo
        $tabela = new Prazo();
        $tabela->num_processo = $processo->id;
        $tabela->descricao = $request->descricao;
        $tabela->data_ini = Carbon::createFromFormat('d/m/Y', $request->data_ini)->format('Y-m-d');
        $tabela->data_fim = Carbon::createFromFormat('d/m/Y', $request->data_fim)->format('Y-m-d');
        $tabela->usuario_id = $request->usuario_id;

        $tabela->save();

        return redirect()->route('painel-adv.prazos.index');
    }



    public function edit(Prazo $item)
    {
        $item->data_ini = Carbon::parse($item->data_ini)->format('d/m/Y');
        $item->data_fim = Carbon::parse($item->data_fim)->format('d/m/Y');

        return view('painel-adv.prazos.edit', ['item' => $item]);
    }

    public function editar(Request $request, Prazo $item)
    {
        $item->descricao = $request->descricao;
        $item->data_ini = Carbon::createFromFormat('d/m/Y', $request->data_ini)->format('Y-m-d');
        $item->data_fim = Carbon::createFromFormat('d/m/Y', $request->data_fim)->format('Y-m-d');
        $item->status = $request->status;
        $item->save();

        return redirect()->route('painel-adv.prazos.index')->with('success', 'Prazo atualizado com sucesso.');
    }

    public function delete(Prazo $item)
    {
        $item->delete();
        return redirect()->route('painel-adv.prazos.index');
    }

    public function complete(Prazo $item)
    {
        $item->status = 'Cumprido';
        $item->save();
        return redirect()->route('painel-adv.prazos.index')->with('success', 'Prazo marcado como cumprido.');
    }

    public function modal($id)
    {
        $item = Prazo::orderby('id', 'desc')->paginate();
        return view('painel-adv.prazos.index', ['itens' => $item, 'id' => $id]);
    }
}
