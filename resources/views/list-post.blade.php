<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@if(count($posts)>0)
  @foreach($posts->sortByDesc('created_at') as $post)
  <div class="card" id="list-post">
    <div class="card-body" id="tablapost">
      <div align="right">
        @if(Auth::user()!=$post->user)
          <div class="btn-group">
            <button class="btn btn-light btn-sm " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <button id="btnFav" data-post="{{ $post->id }}" class="dropdown-item btnFavorite" ><i class="far fa-star"></i><label id="msg"> Añadir a favoritos</label></button>
            </div>
          </div>
        @endif
          @if(Auth::user()==$post->user)
            <button data-id="{{$post->id}}" id="openmodal" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalEditarPost"><i class="far fa-edit"></i></button>
            @include('modal.edit-post')
            <button data-id="{{$post->id}}" id="openmodal" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalBorrarPost"><i class="far fa-trash-alt"></i></button>
          @endif
      </div>
      <div class="mb-2">
        <a class="h5" style="color:#02709d" href="{{route('post',$post)}}">{{$post->title}}</a>
        <input type="hidden" value="{{$post->id}}" id="post_id"><br>
        <a style="color:grey">Por: {{$post->user->name}}</a><br>
      </div>
      <div>
      <a href="{{route('post',$post)}}" class="ml-3" style="color:silver">Ver los {{count($post->comment)}} comentarios</a>
      </div> 
      <div class="mb-2" align="right">
        <label id="mostrarLike{{ $post->id }}" style="color:grey;">{{ $post->likes }}</label>
        <button data-id="1" type="button" data-post="{{ $post }}" class="js-button-interaction btn btn-light btn-sm"><i class="fas fa-angle-up" style="color:green"></i></button>
        <label id="mostrarDisLike{{ $post->id }}" style="color:grey;">{{ $post->dislikes }}</label>
        <button data-id="0" type="button" data-post="{{ $post }}" class="js-button-interaction btn btn-light btn-sm"><i class="fas fa-angle-down" style="color:red"></i></button>
      </div>
    </div>
  </div>
  <br>
  @endforeach
@else
  <div>
    <p class="alert alert-warning" align="center">Por el momento no existen publicaciones por aquí.</p> 
  </div>       
@endif
<div class="modal fade modalUserFail"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                
            <div class="h5 text-center">
              <br>
              <br>
              <label id="userFail"></label>
              <h4 align="center"><a href="{{ url('/register') }}" class="nav-link" >Crea tu cuenta</a></h4>
              <label>O bien...</label>
              <h4 align="center"><a href="{{ url('/login') }}" class="nav-link" >Inicia sesion</a></h4>
              <br>
              <br>
            </div>
        </div>
    </div>
</div>
@include('modal.delete-post')
<script>
  $('.btnFavorite').click( function()
  {
    var token = $("input[name=_token]").val();
    const idPost = $(this).data('post');
    $.ajax({
      type:'POST',
      headers: {"X-CSRF-TOKEN":token},
      url: '{{ url('addfavorite') }}',
      data: { idPost : idPost, token: token },
      success: function(response)
      {
        if(response.msgfail)
        {
          $('.modalUserFail').modal('show');
          $('#userFail').text(response.msgfail);
        }
        else if(response.msgdelete)
        {
          $('#msg').text(" Añadir a favoritos");
          toastr.options={"positionClass": "toast-bottom-left"};
          toastr.warning(response.msgdelete);         
        }
        else if(response.msgsuccess)
        {
          $('#msg').text(" Borrar de favoritos");
          toastr.options={"positionClass": "toast-bottom-left"};
          toastr.info(response.msgsuccess);
        }       
      }
    });
  }
  );
</script>
<script>
  $('.js-button-interaction').click( function() 
  {
    const post = $(this).data('post');
    const isLike = $(this).data("id");
    $.ajax({
      type: 'GET',
      url: '{{ url('likepost') }}',
      data: {
        idPost: post.id, isLike: isLike
      },
      success: function(response) {
        if(!response.post)
        {
          $('.modalUserFail').modal('show');
          $('#userFail').text(response.msg);
        }
        else
        {
          var likes = response.post.likes;
          var disLikes = response.post.dislikes;
          $('#mostrarLike' + response.post.id).text(likes); 
          $('#mostrarDisLike' + response.post.id).text(disLikes); 
        }               
      }
    });
  });
</script>