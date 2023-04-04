<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Venda as Model;

class Venda extends Component
{

    public $produtosCarrinho;

    public $valorTotal;

    public function render()
    {
        return view('livewire.venda');
    }

    public function mount() {

        $this->produtosCarrinho = Model::where('user_id', Auth::user()->id)->get();

        foreach($this->produtosCarrinho as $produto) {

            $valorProduto = $produto->produtos()->first()->preco * $produto->quantidade;

            $this->valorTotal += $valorProduto;

        }


    }

    public function quantidadeUpdate($carrinhoId , $valor) {
        
        $this->produtosCarrinho->quantidade = $valor;

        $produtoCarrinho = Model::find($carrinhoId);
        $produtoCarrinho->quantidade = $valor;
        $produtoCarrinho->save();


    }

    public function delete($produtoId) {
        Model::find($produtoId)
        ->delete();
        
        $this->produtosCarrinho = Model::where('user_id', Auth::user()->id)->get();

    }

    public function debug() {
        dd($this->valorTotal);
    }
}
