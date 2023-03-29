<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\User;

use Exception;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function addProdutoCarrinho(Request $request, $produtoId) {
        $produto = Produto::all();
        $categoria = Categoria::all();
        try {

            $novoItem = new Venda();

            $novoItem->user_id = Auth::user()->id;
            $novoItem->produto_id = $produtoId;
            $novoItem->quantidade = 1;

            $novoItem->save();
            return redirect()->route('venda.carrinhoUpdateView');
    
        }catch(Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }

    }


    public function carrinhoUpdateView(Request $request) {

        $produtosCarrinho = Venda::all();

        return view('venda.carrinhoUpdate')->with(compact('produtosCarrinho'));

    }

    public function delete(Request $request, $produtoCarrinhoId) {

        try {
            $produtoCarrinho = Venda::find($produtoCarrinhoId);

            if(!$produtoCarrinho){
                throw new Exception('Server Error : produto não encontrado no carrinho');
            }

            $deletedProduto = $produtoCarrinho->delete();

            if($deletedProduto)
            {
            
                flash('Produto excluído com sucesso')->info();
                return redirect()->back();
            }else {
                throw new Exception('Server Error : produto não excluído, erro desconhecido');
            }
        }catch(Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }


    }

}
