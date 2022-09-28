@extends('layouts.template')
@section('seccion') 
<body>
  <br>
  <div id="titulo" class="container" align="center">
    <h4 align="center" style="color:grey">Bienvenido, Registrate ahora y conectate con tu terapeuta !</h4>
  </div>
  <br>
  <br>
  <div>
    <table style="width:20%" class="table table-condensed" align="center">
      @if(count($categoria)>0)
        <thead class="thead-silver"></thead>
        @foreach($categoria as $categorias)
          <tr>
            <td>
              <h4 align="center"><a href="{{ url('/login') }}" class="nav-link" >{{$categorias->name}}</a></h4>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td>
            <p class="alert alert-warning">No hay categorias por aquí</p> 
          </td>
        </tr> 
      @endif
    </table>     
  </div> 
</body>
@endsection