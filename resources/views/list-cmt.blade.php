@if(count($comment)>0)
    @foreach($comment->sortByDesc('created_at') as $comentario)
    <div class="card">
        <div class="card-body">
            <div>
                <img src="https://cdn.iconscout.com/icon/premium/png-512-thumb/profile-1506810-1278719.png" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar">
                <a class="h5" style="color:#2E7FB0">{{$comentario->user->name}}</a>
                @if(Auth::user()==$comentario->user)
                  <button data-id="{{$comentario->id}}" class="btn btn-light btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#modalEditarCmt"><i class="far fa-edit"></i></button>
                  @include('modal.edit-cmt')
                  <button data-id="{{$comentario->id}}" class="btn btn-light btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#borrarCmt{{$comentario->id}}"><i class="far fa-trash-alt"></i></button>
                  @include('modal.delete-cmt')                    
                @endif
                <br>   
                <h8><a style="color:silver">{{$comentario->created_at}}</a></h8>
                <p  align="left"><a style="color:grey">{{$comentario->comment}}</a></p>
            </div>
            <div class="mb-2" align="right">
                <label id="mostrarLike{{ $comentario->id }}" style="color:grey;">{{ $comentario->likes }}</label>
                <button data-id="1" type="button" data-cmt="{{ $comentario }}" class="js-interaction-cmt btn btn-light btn-sm"><i class="far fa-smile" style="color:green"></i></button>
                <label id="mostrarDisLike{{ $comentario->id }}" style="color:grey;">{{ $comentario->dislikes }}</label>
                <button data-id="0" type="button" data-cmt="{{ $comentario }}" class="js-interaction-cmt btn btn-light btn-sm"><i class="far fa-angry" style="color:red"></i></button>
            </div>
        </div>
    </div>
    <br>       
    @endforeach
@else
    <div>
        <p class="alert alert-warning" align="center">No hay comentarios por aquí</p> 
    </div> 
@endif  
<script>
  $('.js-interaction-cmt').click( function() {
    const cmt = $(this).data('cmt');
    const isLike = $(this).data("id");
    $.ajax({
      type: 'GET',
      url: '{{ url('likecmt') }}',
      data: {
        idCmt: cmt.id, isLike: isLike
      },
      success: function(response) {
        var likes = response.cmt.likes;
        var disLikes = response.cmt.dislikes;
        $('#mostrarLike' + response.cmt.id).text(likes); 
        $('#mostrarDisLike' + response.cmt.id).text(disLikes);              
      }
    });
  });
</script>