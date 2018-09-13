<div class="modal fade" id="modal_formulario_editar" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Contenido del modal -->
        <div class="modal-content">
            <!--Cabecera para el modal -->
            <div class="modal-header card-header">
                <!--Titulo para el modal -->
                <h5 class="modal-title">Editar usuario</h5>
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
                <form action="#" id="form_e" type="post">
                    <input type="hidden" id="token_e" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Primer Nombre</label>
                            <input type="text" class="form-control" id="first_name_e"
                                   name="first_name"
                                   value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">Segundo Nombre</label>
                            <input type="text" class="form-control" id="second_name_e"
                                   name="second_name"
                                   value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Primer Apellido</label>
                            <input type="text" class="form-control" id="first_surname_e"
                                   name="first_surname"
                                   value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">Segundo Apellido</label>
                            <input type="text" class="form-control" id="second_surname_e"
                                   name="second_surname" value=""
                                   required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Número de Identidad</label>
                            <input type="text" class="form-control" id="identity_e"
                                   name="identity"
                                   placeholder="Digite el número de identidad" required
                                   value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">Correo</label>
                            <input type="email" class="form-control" id="email_e" name="email"
                                   placeholder="Ingrese el correo electronico" required value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Tipo de Usuario</label>
                            <select class="form-control formulario" name="user_type">
                                <option value="3" selected>Aspirante</option>
                                <option value="4">Catedratico</option>
                            </select>
                        </div>
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