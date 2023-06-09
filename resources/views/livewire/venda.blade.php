
<div class="row justify-content-center">
    <div class="col col-md-10">
      <h1 class="text-center">Carrinho Livewire</h1>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Preco</th>
              <th scope="col">Peso(g)</th>
              <th scope="col">Categoria</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($produtosCarrinho as $produtoCarrinho)
            <tr>
              <th scope="row">{{$produtoCarrinho->id}}</th>
              <td>{{$produtoCarrinho->produtos()->first()->id}}</th>
              <td>{{$produtoCarrinho->produtos()->first()->nome}}</td>
              <td>{{$produtoCarrinho->produtos()->first()->preco}}</td>
              <td>{{$produtoCarrinho->produtos()->first()->peso}}</td>
              <td>{{$produtoCarrinho->produtos()->first()->Categoria()->first()->nome}}</td>
              <td>
                <form method="POST" id="updateQuantidade" 
                action="{{route('venda.carrinhoUpdate', $produtoCarrinho->id, $produtoCarrinho->quantidade)}}">
                @csrf
                  <div class="form-outline" style="width: 15rem;">
                    <input min="1" max="{{$produtoCarrinho->produtos()->first()->quantidade}}" type="number" id="typeNumber" 
                    name="quantidade" class="form-control" value="{{$produtoCarrinho->quantidade}}" 
                    wire:change="quantidadeUpdate({{$produtoCarrinho->id}}, $event.target.value)"/>
                  </div>
                </form>
              </td>
              <td>
                <button type="button" wire:click="delete('{{$produtoCarrinho->id}}')" class="btn btn-danger">Excluir</button>
              </td>
            </tr> 
            @endforeach
          </tbody>
        </table>
        <button type="button" class="btn btn-lg btn-info pull-right" wire:click="debug">debug</button>
    </div>
  </div>
  