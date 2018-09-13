<!-- Estructura del modal para la creación de usuario, estara oculto esperando a que ocurra un evento que lo llame -->
<div class="modal fade" id="modal_formulario_editar" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Contenido del modal -->
        <div class="modal-content">
            <!--Cabecera para el modal -->
            <div class="modal-header card-header">
                <!--Titulo para el modal -->
                <h5 class="modal-title">Editar Campus</h5>
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
                <form action="#" type="post" id="form_e">
                    <input type="hidden" value="{{csrf_token()}}" id="token">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Codigo del campus</label>
                        <input type="text" class="form-control" id="campus_code_e"
                               name="campus_code"
                               placeholder="Ingrese el codigo del campus">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del Campus</label>
                        <input type="text" class="form-control" id="name_e"
                               name="name"
                               placeholder="Ingrese el nombre del campus">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ciudad del campus</label>
                        <input type="text" class="form-control" id="city_e"
                               name="city"
                               placeholder="Ingrese la ciudad del campus">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="edit">Guardar</button>
            </div>
        </div>
    </div>
</div>
