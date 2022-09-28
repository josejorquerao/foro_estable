<div class="modal fade modalPublicarPost" id="modalPublicarPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear publicacion</h5>
        <button align="right" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form id="addPost" >
          @csrf
          <input type="hidden" value="{{$cat->id}}" name="category_id" id="category_id">
          <div align="left">
            <label>Titulo</label>
            <div>
              <input type="text" class="form-control" name="title" id="title" required autocomplete="title" autofocus>
            </div>
          </div>
          <br>
          <div align="left">
            <label>Contenido *</label>
            <div>
              <textarea type="text" class="form-control" name="content" id="content" required autocomplete="content" autofocus></textarea>
            </div>
          </div>
          <div class="modal-footer"> 
            <button type="submit" class="btn btn-primary" id="btnPost">Publicar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- AJAX Insertar -->
<script>
  $('#btnPost').click(function(event){
    event.preventDefault();
    var token = $("input[name=_token]").val();
    var form = $('#addPost');
    var route = "{{route('post.store')}}";
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
          listPost();
          $('#modalPublicarPost').modal('hide');
          $('.modal-backdrop').remove();
        }
      }
    });
  });
</script>