@extends('layout.layout')

@section('content')
<div class="container">
    @auth
    @if(Auth::user()->admin)
    <div class="row">
        <div class="col-2 mb-2">

            <form action="{{route('produto.createView')}}">
                <button  type="submit"  class="btn btn-primary">
                    Criar produto
                </button>
            </form>
    
        </div>
    </div>
    @endif
    @endauth

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preco</th>
                    <th scope="col">Peso(g)</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Categoria</th>
                    @auth
                    <th scope="col">Actions</th>
                    @endauth
                  </tr>
                </thead>
                <tbody>
                    @if(count($produtos))
                        @foreach ($produtos as $produto )
                        <tr>
                            <th scope="row">{{$produto->id}}</th>
                            <td>{{$produto->nome}}</td>
                            <td>{{$produto->preco}}</td>
                            <td>{{$produto->peso}}</td>
                            <td>{{$produto->quantidade}}</td>
                            <td>{{$produto->categoria()->first()->nome}}</td>
                            <div class="row">
                            @auth
                                <td>    
                                    <a href="{{route('produto.updateView' , $produto->id)}}"  class="btn btn-info">
                                        Adicionar ao Carrinho  
                                    </a> 
                                    @if(Auth::user()->admin)

                                    <a href="{{route('produto.updateView' , $produto->id)}}"  class="btn btn-warning">
                                        update  
                                    </a> 

                                    <a href="{{route('produto.delete' , $produto->id)}}" class="btn btn-danger">
                                        Delete
                                    </a>
                                    @endif
                                </td>
                            @endauth
                            </div>
                            
                        </tr>
                        @endforeach
                    @endif
        
                </tbody>
              </table>
        </div>
    </div>
 
</div>
@endsection
