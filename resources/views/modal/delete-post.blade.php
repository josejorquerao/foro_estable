<div class="modal fade modalborrar" id="modalBorrarPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">La publicacion se eliminara.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary deletePost"  data-id="{{$post->id}}" data-token="{{ csrf_token() }}" >Borrar</button>
      </div>
  </div>
</div>
<!-- AJAX Eliminar -->
<script>
  $(".deletePost").click(function(){
  var id = $(this).data("id");
  var token = $(this).data("token");
  var route = "{{route('post.store')}}";
  $.ajax(
  {
    url: route+"/"+id,
    type: 'DELETE',
    dataType: "JSON",
    data: {"id": id, "_method": 'DELETE', "_token": token,},
    success: function (data)
    {
        listPost();
        $('.modalborrar').modal('hide');
        $('.modal-backdrop').remove();
    }
  });
});
</script>