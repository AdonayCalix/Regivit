<br><br>
<div class="card animated fadeIn">
    <div id="capture">
        <div class="card-header">
            <strong>REG-RH.102 Solicitud de Empleo</strong>
        </div>
        <div class="card-body">
            <!-- PORTADA DE REG-R.102-->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-2 align-content-center align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/UNICAH_logo.png"
                         width="150" height="150"
                         alt="">
                </div>
                <div class="col-md-6 text-center font-weight-bold">
                    <h5>UNIVERSIDAD CATÓLICA DE HONDURAS</h5>
                    <h5>"NUESTRA SEÑORA REINA DE LA PAZ"</h5>
                    <h5>SOLICITUD DE EMPLEO</h5>
                    <h5>PERSONAL ADMINISTRATIVO, DOCENTE Y DE SERVICIO</h5>
                </div>
                <div class="col-md-2 align-content-center align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/UNICAH_logo.png"
                         width="150" height="150"
                         alt="">
                </div>
            </div>
            <br>
            <form method="post" action="#" id="formulario">
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Puesto al que aspira</label>
                        <small> *</small>
                        <input type="text" name="aspire_position" class="form-control"
                               placeholder="Ingrese el puesto al que aspira">
                    </div>
                </div>
                <br>
                <p style="font-size: 10px" class="font-italic">OBSERVACIÓN: DESDE EL MOMENTO EN QUE APLICA UNA
                    OPORTUNIDA LABORAL EN LA UNIVERSIDAD CATÓLICA, TODOS LOS
                    DOCUMENTOS FÍSICOS QUE USTED PRESENTE PERTENECEN A LA MISMA. SI EXISTIR COMPROMISO ENTRE
                    PARTES</p>

                <p style="font-size: 10px" class="font-italic">Nota: Los campos donde aparece un * son obligatorios</p>
                <br>
                <!-- DATOS GENERALES-->
                <div class="card-header">
                    <strong>I. DATOS PERSONALES</strong>
                </div>
                <br>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">Primer Nombre</label>
                        <small> *</small>
                        <input type="text" name="first_name" class="form-control"
                               value="{{auth()->user()->first_name}}" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="">Segundo Nombre</label>
                        <small> *</small>
                        <input type="text" name="second_name" class="form-control"
                               value="{{auth()->user()->second_name}}" readonly>
                    </div>
                </div>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">Primer Apellido</label>
                        <small> *</small>
                        <input type="text" name="first_surname" class="form-control"
                               value="{{auth()->user()->first_surname}}" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="">Segundo Apellido</label>
                        <small> *</small>
                        <input type="text" name="second_surname" class="form-control"
                               value="{{auth()->user()->second_surname}}" readonly>
                    </div>
                </div>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">Apellido de casada</label>
                        <input type="text" name="married_surname" class="form-control"
                               placeholder="Ingrese su apellido de casada" onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <label for="">Direccion de domicilio</label>
                        <small> *</small>
                        <input type="text" name="address" class="form-control"
                               placeholder="Ingrese la direccion del domicilio">
                    </div>
                </div>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">Telefono</label>
                        <small> *</small>
                        <input type="text" name="telefono" class="form-control"
                               placeholder="Ingrese su telefono" onkeypress="return valida(event)">
                    </div>
                    <div class="form-group col">
                        <label for="">Celular</label>
                        <small> *</small>
                        <input type="text" name="celular" class="form-control"
                               placeholder="celular" onkeypress="return valida(event)">
                    </div>
                    <div class="form-group col">
                        <label for="">E-mail</label>
                        <small> *</small>
                        <input type="email" name="email" class="form-control"
                               value="{{auth()->user()->email}}" readonly>
                    </div>
                </div>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">Nacionalidad</label>
                        <small> *</small>
                        <select class="form-control formulario" name="nationality">
                            <option value="">[Seleccione]</option>
                            <option value="HN">HONDURAS</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="">Estado Civil</label>
                        <small> *</small>
                        <select class="form-control formulario" name="civil_status">
                            <option value="">[Seleccione]</option>
                            @foreach($civil_status as $status)
                                <option value="{{$status->id}}">{{$status->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="">Edad</label>
                        <small> *</small>
                        <input type="number" name="age" class="form-control"
                               placeholder="Ingrese su edad" onkeypress="return valida(event)"
                               min="1" max="100">
                    </div>
                    <div class="form-group col">
                        <label for="">Número de Identidad</label>
                        <small> *</small>
                        <input type="text" name="identity" class="form-control"
                               value="{{auth()->user()->identity}}" readonly>
                    </div>
                </div>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">Fecha de nacimiento</label>
                        <small> *</small>
                        <input type="date" name="birthdate" class="form-control"
                               placeholder="Fecha Nacimiento...">
                    </div>
                    <div class="form-group col">
                        <label for="">N° IHSS</label>
                        <input type="text" name="ihss" class="form-control"
                               placeholder="Ingrese su número de IHSS">
                    </div>
                    <div class="form-group col">
                        <label for="">N° RAP</label>
                        <input type="text" name="rap" class="form-control"
                               placeholder="Ingrese su número de RAP">
                    </div>
                    <div class=" form-group col">
                        <label for="">Tipo de sangre</label>
                        <small> *</small>
                        <select class="form-control formulario" name="blood">
                            <option value="">[Seleccione]</option>
                            @foreach($blood as $blood_type)
                                <option value="{{$blood_type->id}}">{{$blood_type->description}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">Parroquia a la que pertenece</label>
                        <small> *</small>
                        <select class="form-control formulario" name="parish">
                            <option value="">[Seleccione]</option>
                            @foreach($parishes as $parish)
                                <option value="{{$parish->id}}">{{$parish->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="">Nombre del párroco</label>
                        <small> *</small>
                        <select class="form-control formulario" name="priest">
                            <option value="">[Seleccione]</option>
                            @foreach($priests as $priest)
                                <option value="{{$priest->id}}">{{$priest->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">¿Activo en algun movimiento católico?</label>
                        <small> *</small>
                        <textarea name="catholic_movement" id="" cols="30" rows="5" class="form-control"
                                  placeholder="Ingrese los detalles" onkeypress="return letras(event)"
                        ></textarea>
                    </div>
                </div>

                <!-- Bloque -->
                <div class="row">
                    <div class="form-group col">
                        <label for="">De ser contratado, esta dispuesto a participar en las actividades de
                            la pastoral
                            universitaria de la institución
                            <small> *</small>
                        </label>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="pastoral_activity" value="1" class="form-check-input"
                                   id="si_pastoral">
                            <label for="si_pastoral" class="form-check-label">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="pastoral_activity" value="2" class="form-check-input"
                                   id="no_pastoral">
                            <label for="no_pastoral" class="form-check-label">No</label>
                        </div>

                    </div>
                    <div class="form-group col">
                        <label for="">¿Tiene familiares que laboren en la UNIVERSIDAD CATOLICA?</label>
                        <small> *</small>
                        <br>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="family_university" value="1" class="form-check-input"
                                   id="si_familiar">
                            <label for="si_familiar" class="form-check-label">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="family_university" value="2" class="form-check-input"
                                   id="no_familiar">
                            <label for="no_familiar" class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
                <!-- REFERENCIAS-->
                <div class="card-header">
                    <strong>II. REFERENCIAS</strong>
                    <small> *</small>
                </div>
                <br>
                <h6>De tres referencias con nombres y direciones completas de personas que lo conozcan (No
                    deben ser
                    parientes).</h6>
                <table class="table table-condensed table-bordered">
                    <thead class="card-header text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Relación con la referencias</th>
                        <th>Telefono</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" name="reference_name[]" class="form-control"
                                   onkeypress="return letras(event)"></td>
                        <td><input type="text" name="reference_address[]" class="form-control"></td>
                        <td><input type="text" name="reference_relationship[]" class="form-control"
                                   onkeypress="return letras(event)"></td>
                        <td><input type="text" name="reference_number[]" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="reference_name[]" class="form-control"
                                   onkeypress="return letras(event)"></td>
                        <td><input type="text" name="reference_address[]" class="form-control"></td>
                        <td><input type="text" name="reference_relationship[]" class="form-control"
                                   onkeypress="return letras(event)"></td>
                        <td><input type="text" name="reference_number[]" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="reference_name[]" class="form-control"
                                   onkeypress="return letras(event)"></td>
                        <td><input type="text" name="reference_address[]" class="form-control"></td>
                        <td><input type="text" name="reference_relationship[]" class="form-control"
                                   onkeypress="return letras(event)"></td>
                        <td><input type="text" name="reference_number[]" class="form-control"></td>
                    </tr>


                    </tbody>
                    <br>

                </table>
                <!-- COMPETENCIAS-->
                <div class="card-header">
                    <strong>III. COMPETENCIAS</strong>
                    <small> *</small>
                </div>

                <!-- INCISO A -->
                <br><h6>A. Liste los seis atributos personales más importantes que usted posee y que son
                    útiles para el
                    cargo que aplica: </h6>
                <br>
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="competence[]" class="form-control"
                               placeholder="Primer Atributo..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="competence[]" class="form-control"
                               placeholder="Segundo Atributo..." onkeypress="return letras(event)">
                    </div>
                </div>
                <!-- BLOQUE -->
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="competence[]" class="form-control"
                               placeholder="Tercer Atributo..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="competence[]" class="form-control"
                               placeholder="Cuarto Atributo..." onkeypress="return letras(event)">
                    </div>
                </div>
                <!-- BLOQUE -->
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="competence[]" class="form-control"
                               placeholder="Quinto Atributo..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="competence[]" class="form-control"
                               placeholder="Sexto Atributo..." onkeypress="return letras(event)">
                    </div>
                </div>

                <!-- INCISO C -->
                <br><h6>B. Complete el siguiente cuadro relacionado con su educación y formación
                    academica: </h6>
                <br>
                <table class="table table-bordered">
                    <thead class="card-header text-center">
                    <tr>
                        <th>Educación
                            <small> *</small>
                        </th>
                        <th>Años
                            <small> *</small>
                        </th>
                        <th>Nombre de la institución
                            <small> *</small>
                        </th>
                        <th>Titulo obtenido
                            <small> *</small>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Primaria</td>
                        <td><input type="text" class="form-control date" name="education_years[]"
                                   onkeypress="return valida(event)"></td>
                        <td><input type="text" class="form-control" name="education_school_name[]"></td>
                        <td><input type="text" class="form-control" name="education_degree[]"
                                   onkeypress="return letras(event)"></td>
                    </tr>
                    <tr>
                        <td>Secundaria</td>
                        <td><input type="text" class="form-control date" name="education_years[]"
                                   onkeypress="return valida(event)"></td>
                        <td><input type="text" class="form-control" name="education_school_name[]"></td>
                        <td><input type="text" class="form-control" name="education_degree[]"
                                   onkeypress="return letras(event)"></td>
                    </tr>
                    <tr>
                        <td>Universitaria</td>
                        <td><input type="text" class="form-control date" name="education_years[]"
                                   onkeypress="return valida(event)"></td>
                        <td><input type="text" class="form-control" name="education_school_name[]"></td>
                        <td><input type="text" class="form-control" name="education_degree[]"
                                   onkeypress="return letras(event)"></td>
                    </tr>
                    </tbody>
                </table>

                <!-- INCISO C -->
                <br>
                <h6>D. Liste los seis conocimientos más importantes que usted posee de acuerdo a su
                    educación y al
                    puesto que aplica:
                    <small> *</small>
                </h6>
                <br>
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="knowledge[]" class="form-control"
                               placeholder="Primer Conocimiento..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="knowledge[]" class="form-control"
                               placeholder="Segundo Conocimiento..." onkeypress="return letras(event)">
                    </div>
                </div>
                <!-- BLOQUE -->
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="knowledge[]" class="form-control"
                               placeholder="Tercer Conocimiento..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="knowledge[]" class="form-control"
                               placeholder="Cuarto Conocimiento..." onkeypress="return letras(event)">
                    </div>
                </div>
                <!-- BLOQUE -->
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="knowledge[]" class="form-control"
                               placeholder="Quinto Conocimiento..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="knowledge[]" class="form-control"
                               placeholder="Sexto Conocimiento..." onkeypress="return letras(event)">
                    </div>
                </div>

                <!-- INCISO D -->
                <br>
                <h6>D. Enuncie las habilidades que posee y garantizan que cumplirá las actividades
                    requeridas por el
                    puesto que aplica:
                    <small> *</small>
                </h6>
                <br>
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="skill[]" class="form-control"
                               placeholder="Primer Habilidad..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="skill[]" class="form-control"
                               placeholder="Segunda Habilidad..." onkeypress="return letras(event)">
                    </div>
                </div>
                <!-- BLOQUE -->
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="skill[]" class="form-control"
                               placeholder="Tercera Habilidad..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="skill[]" class="form-control"
                               placeholder="Cuarta Habilidad..." onkeypress="return letras(event)">
                    </div>
                </div>
                <!-- BLOQUE -->
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="skill[]" class="form-control"
                               placeholder="Quinta Habilidad..." onkeypress="return letras(event)">
                    </div>
                    <div class="form-group col">
                        <input type="text" name="skill[]" class="form-control"
                               placeholder="Sexta Habilidad..." onkeypress="return letras(event)">
                    </div>
                </div>

                <!-- INCISO E -->
                <br><h6>E. Complete el siguiente cuadro relacionado con su experiencia de trabajo: </h6>
                <br>
                <table class="table table-bordered">
                    <thead class="card-header text-center">
                    <tr>
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Años trabajados</th>
                        <th>Tres actividades más revelantes desempeñadas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="align-content-center align-items-md-center">
                        <td rowspan="4"><input type="text" class="form-control" name="company_name"></td>
                        <td rowspan="4"><input type="text" class="form-control" name="position"></td>
                        <td rowspan="4"><input type="text" class="form-control" name="worked_years"
                                               onkeypress="return valida(event)">
                        </td>
                    <tr>
                        <td><input type="text" class="form-control" name="activity[]"
                                   onkeypress="return letras(event)"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="activity[]"
                                   onkeypress="return letras(event)"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="activity[]"
                                   onkeypress="return letras(event)"></td>
                    </tr>
                    <tr>

                    </tbody>
                </table>

                <!-- DATOS ECONÓMICOS-->
                <div class="card-header">
                    <strong>IV. Datos Económicos</strong>
                </div>
                <!-- INCISO A -->
                <br><h6>A. Complete el siguiente cuadro relacionado con las personas que dependen
                    económicamente de
                    usted: </h6>
                <br>
                <table class="table table-bordered">
                    <thead class="card-header text-center">
                    <tr>
                        <th>Nombre completo</th>
                        <th>Parentesco</th>
                        <th>Edad</th>
                        <th>Dirección</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" name="dependent_name[]" class="form-control"
                                   placeholder="" onkeypress="return letras(event)"></td>
                        <td><input type="text" name="dependent_relationship[]" class="form-control"
                                   placeholder=""></td>
                        <td><input type="number" name="dependent_age[]" class="form-control"
                                   placeholder="" onkeypress="return valida(event)"></td>
                        <td><input type="text" name="dependent_address[]" class="form-control"
                                   placeholder=""></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="dependent_name[]" class="form-control"
                                   placeholder="" onkeypress="return letras(event)"></td>
                        <td><input type="text" name="dependent_relationship[]" class="form-control"
                                   placeholder=""></td>
                        <td><input type="number" name="dependent_age[]" class="form-control"
                                   placeholder="" onkeypress="return valida(event)"></td>
                        <td><input type="text" name="dependent_address[]" class="form-control"
                                   placeholder=""></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="dependent_name[]" class="form-control"
                                   placeholder="" onkeypress="return letras(event)"></td>
                        <td><input type="text" name="dependent_relationship[]" class="form-control"
                                   placeholder=""></td>
                        <td><input type="number" name="dependent_age[]" class="form-control"
                                   placeholder="" onkeypress="return valida(event)"></td>
                        <td><input type="text" name="dependent_address[]" class="form-control"
                                   placeholder=""></td>
                    </tr>
                    </tbody>
                </table>

                <!-- INCISO B -->
                <br>
                <h6>B. Sueldo mínimo que aceptaria:
                    <small> *</small>
                </h6>
                <input type="number" class="form-control col-sm-4" name="minimun_salary"
                       placeholder="Ingrese el sueldo mínimo que aceptaria"
                       onkeypress="return valida(event)">
                <br>

                <div class="row">
                    <div class="form-group col">
                        <label for="">Lugar y fecha
                            <small> *</small>
                        </label>
                        <input type="text" name="place_date" class="form-control"
                               value="La Ceiba Atlantida, {{\Carbon\Carbon::now()->format('d \d\e m \d\e\l Y')}}">
                    </div>
                    <div class="form-group col">
                        <label for="" data-toggle="modal" data-target="#modal_firma"><strong>Firma (De click
                                aqui)</strong>
                            <small> *</small>
                        </label>
                        <div class="form-control align-content-center" id="contenedor_firma" style="height: 100px">
                            <img src="" alt="" id="img-firma" width="" height="">
                        </div>
                        <input type="hidden" name="signature_path" id="firma" value="">
                    </div>
                </div>
                <br><h6>Aprobada el {{\Carbon\Carbon::now()->format('d/m/Y')}}</h6>
                <div>
                    <div class="float-right">
                        <button type="reset" class="btn btn-secondary">Cancelar</button>
                        <button type="button" id="save" class="btn btn-success">Guardar</button>
                    </div>
                    <br><br>
                    <div class="alert alert-danger mensaje-error alert-dismissible" style="display:none">
                        <ul></ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_firma" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Firma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xs-12">
                    <div class="center-block">
                        <canvas id="signature-pad" width=465 height=150></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="borrar" class="btn btn-secondary">Borrar</button>
                <button type="button" id="guardar-firma" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var canvas = document.querySelector("canvas");
        var firma = new SignaturePad(canvas, {
            backgroundColor: "rgb(255, 255, 255)",
            penColor: "rgb(010,010,010)",
            minWidth: 0.5,
            maxWidth: 1.5
        });

        document.getElementById('borrar').addEventListener("click", function () {
            firma.clear();
        });

        $("#guardar-firma").click(function () {
            var datos = firma.toDataURL();
            $("#firma").attr("value", datos);
            $("#contenedor_firma").removeAttr("style");
            $("#img-firma").attr("src", datos);
            $("#img-firma").attr("height", "100");
            $("#img-firma").attr("width", "500");
            $("#modal_firma").modal('hide');
        });
    })
</script>


<script src="{{asset('js/jquery.mask.js')}}"></script>

<script>
    $('.date').mask('0000 - 0000', {placeholder: "0000 - 0000"});
</script>

<script>

    $(document).ready(function () {
        $("#save").click(function () {

            saveJobForm();

            function saveJobForm() {
                var ruta = '{{route('job_form.store')}}';
                var token = $("#token").val();
                $.ajax({
                    url: ruta,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'post',
                    dataType: 'json',
                    data: $("#formulario").serialize(),
                    success: function (data) {

                        if (data['status'] == true) {
                            $("#save").attr('disabled', true);
                            $.notify("Solicitud de empleo llenada correctamente", "success");
                            $("#contenido").load('{{route('view_job_form.index')}}')

                        } else {
                            $.notify("Tienes que solucionar unos problemas", "error");
                        }

                    },
                    error: function (data) {
                        $(".mensaje-error").find("ul").html('');

                        $(".mensaje-error").css('display', 'block');

                        $.each(data.responseJSON.errors, function (key, value) {

                            $(".mensaje-error").find("ul").append('<li>' + value + '</li>');

                        });
                        $.notify("Tienes que solucionar unos problemas antes", "error");
                    }
                });
            }
        });
    });
</script>

