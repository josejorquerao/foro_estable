@extends('layouts.template')
@section('seccion')
<div>
  @if(session('mensaje'))
  <div class="alert alert-success" align="center">
    {{session('mensaje')}}
  </div>
  @endif        

  <div class="table">
    <table class="table table-borderless" align="center"> 
      <tr align="right">
        <td style="white-space:nowrap; ">
          <!-- <a href="#publicCat"  class="btn btn-outline-primary" data-toggle="modal">Crear categoria</a> -->
        </td>
      </tr>
    </table>
  </div> 

  @if(count($categoria)>0)
    @foreach($categoria as $categorias)
      <div class="card mb-4 ">
        <div clasS="card-body">
          <a class="h5" style="color:#2E7FB0" href="{{route('posts',$categorias)}}">{{$categorias->name}} </a>
          
          <p style="color:grey">{{$categorias->description}}</p>              
          @if(Auth::user()==$categorias->administrador)
          <a href="#borrarCat{{$categorias->id}}" class="close" data-dismiss="modal" data-toggle="modal">x</a>
          @endif  
        </div>
      </div>                 
    @endforeach
  @else
    <div>
    <p class="alert alert-warning" align="center">No hay categorias por aquí</p> 
    </div>
  @endif
</div> 
@endsection