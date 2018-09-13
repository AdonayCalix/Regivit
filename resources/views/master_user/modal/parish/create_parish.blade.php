<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Contenido del modal -->
        <div class="modal-content">
            <!--Cabecera para el modal -->
            <div class="modal-header card-header">
                <!--Titulo para el modal -->
                <h5 class="modal-title">Creación de Parroquia</h5>
                <!--Boton para cerrar el modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Cuerpo para el modal -->
            <div class="modal-body">
                <div class="alert alert-danger mensaje-error" style="display:none">
                    <ul></ul>
                </div>
                <form action="#" method="POST" id="form">
                    <input type="hidden" id="token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre de la Parroquia</label>
                        <input type="text" class="form-control" id="name"
                               name="name"
                               placeholder="Ingrese el nombre de la parrroquia">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="save">Guardar</button>
            </div>
        </div>
    </div>
</div>