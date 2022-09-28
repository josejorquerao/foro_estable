<div class="modal fade" id="modalEditarCmt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar comentario</h5>
                <button align="right" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editCmt">
                <input type="hidden" id ="idcmt" name="cmt">
                @csrf
                <div>
                    <div>
                        <input type="text" class="form-control" name="comment" id="cmtedit"  required autocomplete="comment" autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnEditCmt" type="submit" class="btn btn-primary">Editar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('button[id=openmodalcmt]').on('click',function () {
      var id = $(this).data("id");
      $('#idcmt').val(id);
      var ajax=$.ajax({
        type:"get",
        url: "{{route('datoscmt')}}",
        data:{id:id}
        });
        ajax.done(function(dato)
        {
          var datos=JSON.parse(dato);
          $('#cmtedit').val(datos.aa[0]);
        });
    });
    $('#btnEditCmt').click(function(event){
        event.preventDefault();
        var token = $("input[name=_token]").val();
        var form = $('#editCmt');
        var route = "{{route('editarcmt')}}";
            $.ajax({
                type: "PUT",
                headers: {"X-CSRF-TOKEN":token},
                url: route,
                data: form.serialize(),
                dataType: "json",
                success: function (data) {
                  listCmt();
                  $('#modalEditarCmt').modal('hide');
                  $('.modal-backdrop').remove();
                }
            });
    });
</script>