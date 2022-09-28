<!-- Modal insertar -->
<div class="modal fade" id="publicCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Crear categoria</h5>
            <button align="right" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
            <form action="{{ route('crearcat')}}" method="POST">
                @csrf
                <div>
                <label>Nombre</label>
                <div>
                    <input type="text" class="form-control " name="name"  required autocomplete="name" autofocus>
                </div>
                </div>
                <div>
                <label>Descripcion *</label>
                <div>
                    <textarea type="text" class="form-control" name="description"  required autocomplete="description" autofocus></textarea>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </div>
            </form>
            </div> 

        </div>
    </div>
</div>