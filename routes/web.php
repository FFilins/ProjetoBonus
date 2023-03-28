<?php

use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login' , [LoginController::class, 'loginShow'])->name('login.show');
Route::get('/cadastro' , [LoginController::class, 'cadastroShow'])->name('cadastro.show');
Route::post('/login/autenticar' , [LoginController::class, 'autenticar'])->name('login.autenticar');
Route::post('/cadastro/cadastro' , [LoginController::class, 'cadastro'])->name('login.cadastro');
Route::get('/cadastro/logout' , [LoginController::class, 'logout'])->name('login.logout');


// Route::get('/login' , [AutenticacaoController::class, 'loginShow'])->name('login.show');
// Route::post('/login/autenticar' , [AutenticacaoController::class, 'autenticar'])->name('login.autenticar');
// Route::get('/cadastro' , [AutenticacaoController::class, 'cadastroShow'])->name('cadastro.show');
// Route::post('/cadastro/create' , [AutenticacaoController::class, 'create'])->name('autenticacao.create');
// Route::get('/cadastro/sair' , [AutenticacaoController::class, 'sair'])->name('autenticacao.sair');


Route::get('/categorias' , [CategoriasController::class, 'show'])->name('categorias.show');
Route::get('/categoria/create' , [CategoriasController::class, 'createView'])->name('categoria.createView')
->middleware(['auth', 'IsAdmin']);
Route::post('/categoria/create' , [CategoriasController::class, 'create'])->name('categoria.create')
->middleware(['auth', 'IsAdmin']);
Route::get('/categoria/update/{categoriaId}' , [CategoriasController::class, 'updateView'])->name('categoria.updateView')
->middleware(['auth', 'IsAdmin']);
Route::post('/categoria/update/{categoriaId}', [CategoriasController::class, 'update'])->name('categoria.update')
->middleware(['auth', 'IsAdmin']);
Route::post('/categoria/{categoriaId}' , [CategoriasController::class , 'delete'])->name('categoria.delete')
->middleware(['auth', 'IsAdmin']);


Route::get('/produtos' , [ProdutosController::class, 'show'])->name('produtos.show');
Route::get('/produtos/create' , [ProdutosController::class , 'createView'])->name('produto.createView')
->middleware(['auth', 'IsAdmin']);
Route::post('/produto/create' , [ProdutosController::class, 'create'])->name('produto.create')
->middleware(['auth', 'IsAdmin']);
Route::get('/produtos/update/{produtoId}' , [ProdutosController::class , 'updateView'])->name('produto.updateView')
->middleware(['auth', 'IsAdmin']);
Route::post('/produtos/update/{produtoID}' , [ProdutosController::class, 'update'])->name('produto.update')
->middleware(['auth', 'IsAdmin']);
Route::post('/produto/{produtoId}' , [ProdutosController::class , 'delete'])->name('produto.delete')
->middleware(['auth', 'IsAdmin']);

Route::get('/carrinho/{produtoId}' , [VendaController::class, 'addProdutoCarrinho'])->name('venda.addProdutoCarrinho')
->middleware('auth');
Route::get('/carrinho' , [VendaController::class, 'CarrinhoUpdateView'])->name('venda.carrinhoUpdate')
->middleware('auth');
