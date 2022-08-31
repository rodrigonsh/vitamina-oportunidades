<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OportunidadeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'doLogin'])->name('login.doLogin'); 

Route::post('/nova_oportunidade', [OportunidadeController::class, 'new'])->name('oportunidade.new'); 
Route::post('/oportunidade/{id}/updateStatus', [OportunidadeController::class, 'updateStatus'])->name('oportunidade.updateStatus'); 

Route::post('/novo_produto', [ProdutoController::class, 'new'])->name('produto.new'); 
Route::post('/novo_cliente', [ClienteController::class, 'new'])->name('cliente.new'); 