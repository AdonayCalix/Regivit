<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Contenido del modal -->
        <div class="modal-content">
            <!--Cabecera para el modal -->
            <div class="modal-header card-header">
                <!--Titulo para el modal -->
                <h5 class="modal-title">Creación de usuario</h5>
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
                <form action="#" id="form" type="post">
                    <input type="hidden" id="token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">1. Primer Nombre</label>
                            <input type="text" class="form-control" id="first_name"
                                   name="first_name"
                                   placeholder="Ingrese el primer nombre" onkeypress="return letras(event)">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">2. Segundo Nombre</label>
                            <input type="text" class="form-control" id="second_name"
                                   name="second_name"
                                   placeholder="Ingrese el segundo nombre" onkeypress="return letras(event)" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">3. Primer Apellido</label>
                            <input type="text" class="form-control" id="first_surname"
                                   name="first_surname"
                                   placeholder="Ingrese el primer apellido" onkeypress="return letras(event)" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">4. Segundo Apellido</label>
                            <input type="text" class="form-control" id="segundo apellido"
                                   name="second_surname" placeholder="Ingrese el segundo apellido"
                                   onkeypress="return letras(event)" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">5. Número de Identidad</label>
                            <input type="text" class="form-control" id="identity"
                                   name="identity"
                                   placeholder="Digite el número de identidad" onkeypress="return valida(event)"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">6. Correo</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="Ingrese el correo electronico" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">7. Tipo de Usuario</label>
                            <select class="form-control formulario" id="user_type" name="user_type" readonly="true">
                                <option value="4">Catedratico</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">8. Contraseña</label>
                            <input type="password" class="form-control" id="password"
                                   name="password"
                                   placeholder="Ingrese la contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">8. Facultad</label>
                            <select class="form-control" name="faculty">
                                @foreach($faculties as $faculty)
                                    <option value="{{$faculty->code}}">{{$faculty->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button href="#" type="button" class="btn btn-success" id="save">Guardar
                </button>
            </div>
        </div>
    </div>
</div>