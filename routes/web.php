<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AudienciasController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProcessosController;
use App\Http\Controllers\PrazosController;
use App\Http\Controllers\VarasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', HomeController::class)->name('home');

Route::post('painel', [UsersController::class, 'login'])->name('usuarios.login');
Route::get('/', [UsersController::class, 'logout'])->name('usuarios.logout');
Route::get('home-admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('painel-adv/audiencias', [AudienciasController::class, 'index'])->name('painel-adv.audiencias.index');

//ROTAS PARA AUDIÊNCIAS
// Route::get('audiencias', [AudienciasController::class, 'index'])->name('audiencias.index');
Route::post('audiencias', [AudienciasController::class, 'insert'])->name('audiencias.insert');
Route::get('audiencias/inserir', [AudienciasController::class, 'create'])->name('audiencias.inserir');
// Route::put('audiencias/{item}', [AudienciasController::class, 'editar'])->name('audiencias.editar');
// Route::get('audiencias/{item}/edit}', [AudienciasController::class, 'edit'])->name('audiencias.edit');
// Route::get('audiencias/{item}/delete}', [AudienciasController::class, 'modal'])->name('audiencias.modal');
// Route::delete('audiencias/{item}', [AudienciasController::class, 'delete'])->name('audiencias.delete');
Route::get('/getCliente', [ProcessosController::class, 'getCliente'])->name('processos.getCliente');
Route::get('/get-audiencia-details', [AudienciasController::class, 'getAudienciaDetails']);



//ROTAS PARA PROCESSOS
Route::get('processos', [ProcessosController::class, 'index'])->name('processos.index');
Route::post('processos', [ProcessosController::class, 'insert'])->name('processos.insert');
Route::get('processos/inserir', [ProcessosController::class, 'create'])->name('processos.inserir');
Route::put('processos/{item}', [ProcessosController::class, 'editar'])->name('processos.editar');
Route::get('processos/{item}/edit}', [ProcessosController::class, 'edit'])->name('processos.edit');
Route::get('processos/{item}/delete}', [ProcessosController::class, 'modal'])->name('processos.modal');
Route::delete('processos/{item}', [ProcessosController::class, 'delete'])->name('processos.delete');
Route::get('/clientes/search', [ClientesController::class, 'searchByCpf'])->name('clientes.searchByCpf');
Route::get('/empresas/search', [EmpresasController::class, 'searchByCnpj'])->name('empresas.searchByCnpj');
Route::get('/get-varas', [ProcessosController::class, 'getVaras']);
Route::delete('processos/{processo}/anexos/{anexo}', 'ProcessosController@deleteAnexo');
Route::get('audiencias', [ProcessosController::class, 'audiencias'])->name('audiencias.index');

//ROTAS PARA CLIENTES
Route::get('clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::post('clientes', [ClientesController::class, 'insert'])->name('clientes.insert');
Route::get('clientes/inserir', [ClientesController::class, 'create'])->name('clientes.inserir');
Route::put('clientes/{item}', [ClientesController::class, 'editar'])->name('clientes.editar');
Route::get('clientes/{item}/edit}', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::get('clientes/{item}/delete}', [ClientesController::class, 'modal'])->name('clientes.modal');
Route::delete('clientes/{item}', [ClientesController::class, 'delete'])->name('clientes.delete');

//ROTAS PARA EMPRESAS
Route::get('empresas', [EmpresasController::class, 'index'])->name('empresas.index');
Route::post('empresas', [EmpresasController::class, 'insert'])->name('empresas.insert');
Route::get('empresas/inserir', [EmpresasController::class, 'create'])->name('empresas.inserir');
Route::put('empresas/{item}', [EmpresasController::class, 'editar'])->name('empresas.editar');
Route::get('empresas/{item}/edit}', [EmpresasController::class, 'edit'])->name('empresas.edit');
Route::get('empresas/{item}/delete}', [EmpresasController::class, 'modal'])->name('empresas.modal');
Route::delete('empresas/{item}', [EmpresasController::class, 'delete'])->name('empresas.delete');
// Rota para busca de empresas por CNPJ
Route::get('api/empresas', [EmpresasController::class, 'search'])->name('empresas.search');

//ROTAS PARA PRAZOS
Route::get('prazos', [PrazosController::class, 'index'])->name('prazos.index');
Route::post('prazos', [PrazosController::class, 'insert'])->name('prazos.insert');
Route::get('prazos/inserir', [PrazosController::class, 'create'])->name('prazos.inserir');
Route::put('prazos/{item}', [PrazosController::class, 'editar'])->name('prazos.editar');
Route::get('prazos/{item}/edit}', [PrazosController::class, 'edit'])->name('prazos.edit');
Route::get('prazos/{item}/delete}', [PrazosController::class, 'modal'])->name('prazos.modal');
Route::delete('prazos/{item}', [PrazosController::class, 'delete'])->name('prazos.delete');

//ROTAS PARA COMARCAS
Route::get('comarcas', [ComarcasController::class, 'index'])->name('comarcas.index');
Route::post('comarcas', [ComarcasController::class, 'insert'])->name('comarcas.insert');
Route::get('comarcas/inserir', [ComarcasController::class, 'create'])->name('comarcas.inserir');
Route::put('comarcas/{item}', [ComarcasController::class, 'editar'])->name('comarcas.editar');
Route::get('comarcas/{item}/edit}', [ComarcasController::class, 'edit'])->name('comarcas.edit');
Route::get('comarcas/{item}/delete}', [ComarcasController::class, 'modal'])->name('comarcas.modal');
Route::delete('comarcas/{item}', [ComarcasController::class, 'delete'])->name('comarcas.delete');

//ROTAS PARA VARAS
Route::get('varas', [VarasController::class, 'index'])->name('varas.index');
Route::post('varas', [VarasController::class, 'insert'])->name('varas.insert');
Route::get('varas/inserir', [VarasController::class, 'create'])->name('varas.inserir');
Route::put('varas/{item}', [VarasController::class, 'editar'])->name('varas.editar');
Route::get('varas/{item}/edit}', [VarasController::class, 'edit'])->name('varas.edit');
Route::get('varas/{item}/delete}', [VarasController::class, 'modal'])->name('varas.modal');
Route::delete('varas/{item}', [VarasController::class, 'delete'])->name('varas.delete');

// Route::put('admin/{usuario}', [AdminController::class, 'editar'])->name('admin.editar');
// Route::get('home-admin', [AdminController::class, 'index'])->name('admin.index');

// Route::get('/', function () {
//     return view('welcome');
// });
