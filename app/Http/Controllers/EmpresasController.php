<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class EmpresasController extends Controller
{
    public function index()
    {
        $itens = Empresa::orderBy('id', 'desc')->paginate();
        return view('painel-adv.empresas.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('painel-adv.empresas.create');
    }

    public function insert(Request $request)
    {
        $tabela = new Empresa();
        $tabela->nome = $request->nome;
        $tabela->cnpj = $request->cnpj;
        $tabela->telefone = $request->telefone;
        $tabela->telefone2 = $request->telefone2;
        $tabela->email = $request->email;
        $tabela->endereco = $request->endereco;
        $tabela->preposto = $request->preposto;
        $tabela->save();
        return redirect()->route('empresas.index');
    }

    public function edit(Empresa $item)
    {
        return view('painel-adv.empresas.edit', ['item' => $item]);
    }

    public function editar(Request $request, Empresa $item)
    {
        $item->nome = $request->nome;
        $item->cnpj = $request->cnpj;
        $item->telefone = $request->telefone;
        $item->telefone2 = $request->telefone2;
        $item->email = $request->email;
        $item->endereco = $request->endereco;
        $item->preposto = $request->preposto;
        $item->save();
        return redirect()->route('empresas.index');
    }

    public function delete(Empresa $item)
    {
        $item->delete();
        return redirect()->route('empresas.index');
    }

    public function modal($id)
    {
        $item = Empresa::orderby('id', 'desc')->paginate();
        return view('painel-adv.empresas.index', ['itens' => $item, 'id' => $id]);
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $empresas = Empresa::where('cnpj', 'like', "%{$q}%")->paginate();

        return response()->json($empresas);
    }

    public function searchByCnpj(Request $request)
    {
        $cnpj = $request->get('cnpj');
        $empresa = Empresa::where('cnpj', $cnpj)->first();
        return response()->json($empresa);
    }

    public function documentosEmpresa(Empresa $item)
    {
        return view('painel-adv.empresas.documentosEmpresa', ['item' => $item]);
    }

    public function documentos(Empresa $item)
    {
        return view('painel-adv.empresas.documentos', ['item' => $item]);
    }

    public function addDocument(Request $request, $empresa_id)
    {
        $empresa = Empresa::findOrFail($empresa_id);
        $nome_documentos = $request->input('nome_documento');  // Note que agora é nome_documentos no plural
        $files = $request->file('documentos');

        if ($files && $nome_documentos) {
            foreach ($files as $index => $file) {
                $path = $file->store('documentos_empresas', 'public');
                $nome_documento = isset($nome_documentos[$index]) ? $nome_documentos[$index] : null;  // Pega o nome correspondente

                $empresa->documentoEmpresas()->create([
                    'nome_arquivo' => $path,
                    'tipo' => 'pdf',
                    'nome_documento' => $nome_documento  // Agora é uma string
                ]);
            }
        }

        return redirect()->back()->with('message', 'Documento(s) adicionado(s) com sucesso.');
    }


    public function deleteDocument(Request $request, $empresa_id, $documento_id)
    {
        $empresa = Empresa::findOrFail($empresa_id);
        $documento = $empresa->documentoEmpresas->where('id', $documento_id)->first();
        if ($documento) {
            Storage::disk('public')->delete($documento->nome_arquivo);
            $documento->delete();
            return redirect()->back()->with('message', 'Documento deletado com sucesso.');
        } else {
            return redirect()->back()->with('message', 'Documento não encontrado.');
        }
    }

    public function downloadDocument($empresa_id, $documento_id)
    {
        $empresa = Empresa::findOrFail($empresa_id);
        $documento = $empresa->documentoEmpresas->where('id', $documento_id)->first();
        if ($documento) {
            $path = storage_path("app/public/{$documento->nome_arquivo}");
            return Response::download($path, basename($documento->nome_arquivo), [
                'Content-Type' => 'application/pdf',
            ]);
        } else {
            return redirect()->back()->with('message', 'Documento não encontrado.');
        }
    }
}
