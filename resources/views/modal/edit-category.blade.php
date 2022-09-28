<!-- Modal editar -->
<div class="modal fade" id="editar{{$categorias->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar categoria</h5>
            <button align="right" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            <form action="{{route('editarcat',$categorias)}}" method="POST">
                @method('PUT')
                @csrf
                <div>
                <div>
                    <input type="text" value="{{$categorias->name}}" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>
                </div>
                </div>
                <br>
                <div>
                <div>
                    <textarea type="text" class="form-control" name="description"  required autocomplete="description" autofocus>{{$categorias->description}}</textarea>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>