@extends('layout.layout')

@section('content')
<div class="container">
    @auth
    @if(Auth::user()->admin)
    <div class="row">
        <div class="col-2 mb-2">

            <form action="{{route('categoria.createView')}}">
                <button  type="submit"  class="btn btn-primary">
                    Criar categoria
                </button>
            </form>
    
        </div>
    </div>
    @endif
    @endauth

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    @auth
                    <th scope="col">Actions</th>
                    @endauth
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria )
                    <tr>
                        <th scope="row">{{$categoria->id}}</th>
                        <td>{{$categoria->nome}}</td>

                        @auth
                        @if(Auth::user()->admin)
                            <td>
                                <a href="{{route('categoria.delete' , $categoria->id)}}" class="btn btn-danger">
                                    Delete  
                                </a>
                                <a href="{{route('categoria.updateView' , $categoria->id)}}"  class="btn btn-warning">
                                    update  
                                </a> 
                            </td>
                          
                        @endif
                        @endauth
                        
                      </tr>
                    @endforeach
               
        
                </tbody>
              </table>
        </div>
    </div>
 
</div>
@endsection
