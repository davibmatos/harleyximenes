<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ClientesController extends Controller
{
    public function index()
    {
        $itens = Cliente::orderBy('id', 'desc')->paginate();
        return view('painel-adv.clientes.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.clientes.create');
    }

    public function insert(Request $request)
    {
        $clienteExistente = Cliente::where('cpf', $request->cpf)->first();

        if ($clienteExistente) {
            return redirect()->route('clientes.index')->with('error', 'Cliente com esse CPF já existe.');
        }

        $tabela = new Cliente();
        $tabela->nome = $request->nome;
        $tabela->cpf = $request->cpf;
        $tabela->telefone = $request->telefone;
        $tabela->telefone2 = $request->telefone2;
        $tabela->funcao = $request->funcao;
        $tabela->email = $request->email;
        $tabela->salario = $request->salario;
        $tabela->endereco = $request->endereco;
        $tabela->ecivil = $request->ecivil;
        $tabela->save();


        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $file) {
                $path = $file->store('documentos', 'public');
                $tabela->documentos()->create([
                    'nome_arquivo' => $path,
                    'tipo' => 'pdf'
                ]);
            }
        }

        return redirect()->route('clientes.index');
    }

    public function edit(Cliente $item)
    {
        return view('painel-adv.clientes.edit', ['item' => $item]);
    }

    public function editar(Request $request, Cliente $item)
    {
        $item->nome = $request->nome;
        $item->cpf = $request->cpf;
        $item->telefone = $request->telefone;
        $item->telefone2 = $request->telefone2;
        $item->funcao = $request->funcao;
        $item->email = $request->email;
        $item->salario = $request->salario;
        $item->save();

        if ($request->hasFile('documentos')) {
            // Remove os arquivos antigos
            foreach ($item->documentos as $doc) {
                Storage::disk('public')->delete($doc->nome_arquivo);
                $doc->delete();
            }

            // Adiciona os novos arquivos
            foreach ($request->file('documentos') as $file) {
                $path = $file->store('documentos', 'public');
                $item->documentos()->create([
                    'nome_arquivo' => $path,
                    'tipo' => 'pdf'
                ]);
            }
        }

        return redirect()->route('clientes.index');
    }


    public function delete(Cliente $item)
    {
        try {

            dd('cheguei aqui');
            $item->delete();

            return redirect()->route('clientes.index');
        } catch (QueryException $e) {
            return redirect()->route('clientes.index')->with('error', 'Este cliente possui um Processo associado a ele e portanto não poderá ser excluído.');
        }
    }

    public function documentos(Cliente $item)
    {
        return view('painel-adv.clientes.documentos', ['item' => $item]);
    }

    public function deleteDocument(Request $request, $cliente_id, $documento_id)
    {
        $cliente = Cliente::findOrFail($cliente_id);
        $documento = $cliente->documentos->where('id', $documento_id)->first();

        if ($documento) {
            Storage::disk('public')->delete($documento->nome_arquivo);
            $documento->delete();
            return redirect()->back()->with('message', 'Documento deletado com sucesso.');
        } else {
            return redirect()->back()->with('message', 'Documento não encontrado.');
        }
    }

    public function addDocument(Request $request, Cliente $item)
    {
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $file) {
                $path = $file->store('documentos', 'public');
                $nome_documento = $request->input('nome_documento');  // Pega o nome do documento do formulário
                $item->documentos()->create([
                    'nome_arquivo' => $path,
                    'tipo' => 'pdf',
                    'nome_documento' => $nome_documento  // Inclui o nome do documento aqui
                ]);
            }
        }
        return redirect()->back()->with('message', 'Documento(s) adicionado(s) com sucesso.');
    }

    public function modal($id)
    {
        $item = Cliente::orderby('id', 'desc')->paginate();
        return view('painel-adv.clientes.index', ['itens' => $item, 'id' => $id]);
    }

    public function getEmpresa(Request $request)
    {
        $cnpj = $request->get('cnpj');
        $empresa = Empresa::where('cnpj', $cnpj)->first();
        if ($empresa) {
            return response()->json(['nome' => $empresa->nome]);
        } else {
            return response()->json(['error' => 'Empresa não encontrada'], 404);
        }
    }

    public function searchByCpf(Request $request)
    {
        $cpf = $request->get('cpf');
        $cliente = Cliente::where('cpf', $cpf)->first();
        return response()->json($cliente);
    }
}
