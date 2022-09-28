<div class="modal fade" id="modalEditarPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar publicacion</h5>
        <button align="right" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form id="editPost">
        <input type="hidden" id ="idpost" name="cocos">
          @csrf
          <div>
            <div>
              <input type="text" value="" class="form-control" name="title" id="titledit"  required autocomplete="title" autofocus>
            </div>
          </div>
          <br>
          <div>
            <div>
              <textarea type="text" class="form-control" name="content" id="contentedit"  required autocomplete="content" autofocus></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button id="btnEdit" type="submit" class="btn btn-primary">Editar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    $('button[id=openmodal]').on('click',function () {
      var id = $(this).data("id");
      $('#idpost').val(id);
      var ajax=$.ajax({
        type:"get",
        url: "{{route('datospost')}}",
        data:{id:id}
        });
        ajax.done(function(dato)
        {
          var datos=JSON.parse(dato);
          $('#titledit').val(datos.aa[0]);
          $('#contentedit').val(datos.aa[1]);
        });
    });
    $('#btnEdit').click(function(event){
        event.preventDefault();
        var token = $("input[name=_token]").val();
        var form = $('#editPost');
        var route = "{{route('editarpost')}}";
            $.ajax({
                type: "PUT",
                headers: {"X-CSRF-TOKEN":token},
                url: route,
                data: form.serialize(),
                dataType: "json",
                success: function (data) {
                  listPost();
                  $('#modalEditarPost').modal('hide');
                  $('.modal-backdrop').remove();
                }
            });
    });
</script>