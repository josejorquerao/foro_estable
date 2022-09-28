@extends('layouts.template')
@section('seccion')
<!DOCTYPE html>
<html lang="es"> 
    <body>
      <div>
        @if(session('mensaje'))
          <div class="alert alert-success">
            {{session('mensaje')}}
          </div>
        @endif
        <div class="table">
          @if(Auth::user())
          <input type="hidden" value="{{$cat->id}}" id="category_id">
          <a style="color:white;background:#00aef5;" href="#modalPublicarPost" class="btn btn-primary" data-toggle="modal"><i class="fas fa-pen-fancy"></i> Nuevo post</a>

          <div class="btn-group dropright">
            <a type="button" style="color:grey;background:#EDEDED;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-list-ul"></i> Biblioteca
            </a>
            <div class="dropdown-menu">
              <a href="{{url('myfavorites')}}" type="button" id="btnListFav" class="dropdown-item" ><i class="far fa-star"></i> Mis Favoritos</a>
              <a href="{{url('myposts')}}" type="button" id="btnListPost" class="dropdown-item" ><i class="far fa-bookmark"></i> Mis Publicaciones</a>
            </div>       
          </div> 
          @else
          <a href="#" class="btn btn-outline-primary" data-toggle="modal">Inicia sesion para crear una publicacion</a>
          @endif
          @include('modal.create-post')              
        </div>
        <div id="mostrarPost">
        </div>
      </div>
    </body>
</html>
<!-- AJAX Mostrar -->
<script>
    $(document).ready(function(){
        listPost();
    });
    var listPost = function(){
        var idCat = document.getElementById('category_id').value;
        var dataString = "id="+idCat;
        $.ajax({
            type: 'get',
            url: '{{url('listpost')}}',
            data: dataString,
            success: function(data){
                $('#mostrarPost').empty().html(data);
            }
        });
    }
</script>
@endsection