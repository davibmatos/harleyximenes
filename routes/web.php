<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

// Route::put('admin/{usuario}', [AdminController::class, 'editar'])->name('admin.editar');
// Route::get('home-admin', [AdminController::class, 'index'])->name('admin.index');

// Route::get('/', function () {
//     return view('welcome');
// });
