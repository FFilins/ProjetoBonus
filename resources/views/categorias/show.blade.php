@extends('layout.layout')

@section('content')
<div class="container">
    @auth
    @if(Auth::user()->admin)
    <div class="row">
        <div class="col-2">

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
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    @auth
                    <th scope="col2">Actions</th>
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
                            <div class="row">
                                <form action="{{route('categoria.delete' , $categoria->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        Delete  
                                    </button> 
                                </form>
                                <td>
                            
                                    <a href="{{route('categoria.updateView' , $categoria->id)}}"  class="btn btn-warning">
                                        update  
                                    </a> 
                              
                                </td>
                            </div>
                          
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
