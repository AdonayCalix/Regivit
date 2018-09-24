<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Contenido del modal -->
        <div class="modal-content">
            <!--Cabecera para el modal -->
            <div class="modal-header card-header">
                <!--Titulo para el modal -->
                <h5 class="modal-title">Creación de facultad</h5>
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
                <form action="#" method="post" id="form">
                    <input type="hidden" value="{{csrf_token()}}" id="token">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Codigo de la facultad</label>
                        <input type="text" class="form-control" id="code"
                               name="code"
                               placeholder="Ingrese el codigo de la facultad">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre de la facultad</label>
                        <input type="text" class="form-control" id="name"
                               name="name"
                               placeholder="Ingrese el nombre de la facultad">
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