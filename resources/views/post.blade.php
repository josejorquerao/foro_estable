@extends('layouts.template')
@section('seccion')
<!DOCTYPE html>
<html lang="es"> 
    <body>
      <div>

        <div>
          <table class="table table-borderless" align="center">
            <tr>
              <td colspan="2">
                <input type="hidden" value="{{$post->id}}" name="posteo" id="cmtpost_id"> 
                <a class="h5" style="color:#2E7FB0" align="left">{{$post->title}}</a>
                <a style="color:grey">Por: {{$post->user->name}}</a>
                <p style="color:silver">{{$post->created_at}}</p>
                <p  align="left"><a style="color:grey">{{$post->content}}</a></p>
              </td>
            </tr>
            <tr align="right">
              <td>
                <label id="mostrarLike{{ $post->id }}" style="color:grey;">{{ $post->likes }}</label>
                <button data-id="1" type="button" data-post="{{ $post }}" class="js-button-interaction btn btn-outline-light btn-sm"><i class="fas fa-angle-up" style="color:green"></i></button>
                <label id="mostrarDisLike{{ $post->id }}" style="color:grey;">{{ $post->dislikes }}</label>
                <button data-id="0" type="button" data-post="{{ $post }}" class="js-button-interaction btn btn-outline-light btn-sm"><i class="fas fa-angle-down" style="color:red"></i></button>
              </td>
            </tr>
          </table>
        </div>
        

        <!-- Caja de comentarios -->
        <div>
          <form id="addCmt">
            @csrf
            <table class="table table-condensed" align="center">
              <tr>
                <td>
                  <div class="panel-body">
                    <div class="form-group">
                    <input type="hidden" value="{{$post->id}}" name="post_id">
                    </div>
                    <div class="form-group">
                      <textarea name="comment" class="form-control" placeholder="Escribe aquí tu comentario..." required autocomplete="comment"></textarea>
                    </div>
                    <div align="right">
                      <button type="submit" class="btn btn-outline-primary" id="btnCmt">Comentar</button>
                    </div>
                 </div>
                </td>
              </tr>
            </table>
          </form>
        </div>
        @if(session('mensaje'))
          <div class="alert alert-success" align="center">
            {{session('mensaje')}}
          </div>
        @endif
        <div id="mostrarCmt">
        </div>
      </div> 
    </body>
</html>
<!-- AJAX Mostrar -->
<script>
    $(document).ready(function(){
        listCmt();
    });
    var listCmt = function(){
        var idPost = document.getElementById('cmtpost_id').value;
        var dataString = "id="+idPost;
        $.ajax({
            type: 'get',
            url: '{{url('listcmt')}}',
            data: dataString,
            success: function(data){
                $('#mostrarCmt').empty().html(data);
            }
        });
    }
</script>
<!-- AJAX Insertar -->
<script>
  $('#btnCmt').click(function(event){
    event.preventDefault();
    var token = $("input[name=_token]").val();
    var form = $('#addCmt');
    var route = "{{route('cmt.store')}}";
    $.ajax({
      type: "post",
      headers: {"X-CSRF-TOKEN":token},
      url: route,
      data: form.serialize(),
      dataType: "json",
      success: function (data) 
      {
        if(data.success == 'true' )
        {
          listCmt();
        }
      }
    });
  });
</script>

@endsection