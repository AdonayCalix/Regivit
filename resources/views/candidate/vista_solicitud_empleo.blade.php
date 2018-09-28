<br>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong>Ya has llenado este formulario</strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@foreach($job_applications as $item)
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
                             width="150" height="150" class="img-fluid"
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
                             width="150" height="150" class="img-fluid"
                             alt="">
                    </div>
                </div>
                <br>
                <form id="formulario">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Puesto al que aspira</label>
                            <input type="text" name="aspire_position" class="form-control"
                                   value="{{$item->aspire_position}}">
                        </div>
                    </div>
                    <br>
                    <p style="font-size: 10px" class="font-italic">OBSERVACIÓN: DESDE EL MOMENTO EN QUE APLICA UNA
                        OPORTUNIDA LABORAL EN LA UNIVERSIDAD CATÓLICA, TODOS LOS
                        DOCUMENTOS FÍSICOS QUE USTED PRESENTE PERTENECEN A LA MISMA. SI EXISTIR COMPROMISO ENTRE
                        PARTES</p>
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
                            <input type="text" name="first_name" class="form-control" id="first_name"
                                   value="{{auth()->user()->first_name}}">
                        </div>
                        <div class="form-group col">
                            <label for="">Segundo Nombre</label>
                            <input type="text" name="second_name" class="form-control" id="second_name"
                                   value="{{auth()->user()->second_name}}">
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Primer Apellido</label>
                            <input type="text" name="first_surname" class="form-control" id="first_surname"
                                   value="{{auth()->user()->first_surname}}">
                        </div>
                        <div class="form-group col">
                            <label for="">Segundo Apellido</label>
                            <input type="text" name="second_surname" class="form-control" id="second_surname"
                                   value="{{auth()->user()->second_surname}}">
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Apellido de casada</label>
                            <input type="text" name="married_surname" class="form-control"
                            >
                        </div>
                        <div class="form-group col">
                            <label for="">Direccion de domicilio</label>
                            <input type="text" name="address" class="form-control"
                                   value="{{$item->address}}">
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" class="form-control"
                                   value="{{$item->telefono}}">
                        </div>
                        <div class="form-group col">
                            <label for="">Celular</label>
                            <input type="text" name="celular" class="form-control"
                                   value="{{$item->celular}}">
                        </div>
                        <div class="form-group col">
                            <label for="">E-mail</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   value="{{auth()->user()->email}}">
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Nacionalidad</label>
                            <select class="form-control formulario" name="nationality">
                                <option value="HN">HONDURAS</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Estado Civil</label>
                            <select class="form-control formulario" name="civil_status">
                                @foreach($status_civil as $statu_civil)
                                    @if($statu_civil->id == $item->tipo_estado_civil)
                                        <option selected
                                                value="{{$item->tipo_estado_civil}}">{{$item->civil_status}}</option>
                                    @else
                                        <option value="{{$statu_civil->id}}">{{$statu_civil->descripcion}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Edad</label>
                            <input type="number" name="age" class="form-control"
                                   value="{{$item->age}}">
                        </div>
                        <div class="form-group col">
                            <label for="">Número de Identidad</label>
                            <input type="text" name="identity" class="form-control" id="identity"
                                   value="{{auth()->user()->identity}}">
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Fecha de nacimiento</label>
                            <input type="date" name="birthdate" class="form-control"
                                   value="{{$item->birthdate}}">
                        </div>
                        <div class="form-group col">
                            <label for="">N° IHSS</label>
                            <input type="text" name="ihss" class="form-control"
                                   value="{{$item->ihss}}">
                        </div>
                        <div class="form-group col">
                            <label for="">N° RAP</label>
                            <input type="text" name="rap" class="form-control"
                                   value="{{$item->rap}}">
                        </div>
                        <div class=" form-group col">
                            <label for="">Tipo de sangre</label>
                            <select class="form-control formulario" name="blood">
                                @foreach($bloods as $blood)
                                    @if($blood->id == $item->tipo_sangre)
                                        <option selected value="{{$item->tipo_sangre}}">{{$item->blood_type}}</option>
                                    @else
                                        <option value="{{$blood->id}}">{{$blood->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Parroquia a la que pertenece</label>
                            <select class="form-control formulario" name="parish">
                                @foreach($parishes as $parish)
                                    @if($parish->id == $item->id_parish)
                                        <option selected value="{{$item->id_parish}}">{{$item->parish_name}}</option>
                                    @else
                                        <option value="{{$parish->id}}">{{$parish->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Nombre del párroco</label>
                            <select class="form-control formulario" name="priest">
                                @foreach($priests as $priest)
                                    @if($priest->id == $item->id_parish_priest)
                                        <option selected
                                                value="{{$item->id_parish_priest}}">{{$item->priest_name}}</option>
                                    @else
                                        <option value="{{$priest->id}}">{{$priest->name}}</option>
                                    @endif|
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">¿Activo en algun movimiento católico?</label>
                            <textarea name="catholic_movement" id="" cols="30" rows="5" class="form-control">{{$item->catholic_movement}}
                        </textarea>
                        </div>
                    </div>

                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">De ser contratado, esta dispuesto a participar en las actividades de
                                la pastoral
                                universitaria de la institución</label>
                            @if($item->pastoral_activity == 1)
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="pastoral_activity" value="1" class="form-check-input"
                                           id="si_pastoral" checked>
                                    <label for="si_pastoral" class="form-check-label">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="pastoral_activity" value="2" class="form-check-input"
                                           id="no_pastoral">
                                    <label for="no_pastoral" class="form-check-label">No</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="pastoral_activity" value="1" class="form-check-input"
                                           id="si_pastoral">
                                    <label for="si_pastoral" class="form-check-label">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="pastoral_activity" value="2" class="form-check-input"
                                           id="no_pastoral" checked>
                                    <label for="no_pastoral" class="form-check-label">No</label>
                                </div>
                            @endif

                        </div>
                        <div class="form-group col">
                            <label for="">¿Tiene familiares que laboren en la UNIVERSIDAD CATOLICA?</label><br>
                            @if($item->family_university == 1)
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="family_university" value="1" class="form-check-input"
                                           id="si_familiar" checked>
                                    <label for="si_familiar" class="form-check-label">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="family_university" value="2" class="form-check-input"
                                           id="no_familiar">
                                    <label for="no_familiar" class="form-check-label">No</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="family_university" value="1" class="form-check-input"
                                           id="si_familiar" readonly>
                                    <label for="si_familiar" class="form-check-label">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="family_university" value="2" class="form-check-input"
                                           id="no_familiar" checked readonly>
                                    <label for="no_familiar" class="form-check-label">No</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- REFERENCIAS-->
                    <div class="card-header">
                        <strong>II. REFERENCIAS</strong>
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
                        @foreach($references as $reference)
                            <tr>
                                <td><input type="text" class="form-control" value="{{$reference->name}}"></td>
                                <td><input type="text" class="form-control" value="{{$reference->address}}"></td>
                                <td><input type="text" class="form-control" value="{{$reference->relationship}}"></td>
                                <td><input type="text" class="form-control" value="{{$reference->number}}"></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <br>

                    </table>
                    <!-- COMPETENCIAS-->
                    <div class="card-header">
                        <strong>III. COMPETENCIAS</strong>
                    </div>

                    <!-- INCISO A -->
                    <br><h6>A. Liste los seis atributos personales más importantes que usted posee y que son
                        útiles para el
                        cargo que aplica: </h6>
                    <br>
                    <div class="row">
                        @foreach($competences as $competence)
                            <div class="form-group col-md-6">
                                <input type="text" name="competence[]" class="form-control"
                                       value="{{$competence->description}}">
                            </div>
                        @endforeach
                    </div>
                    <!-- BLOQUE -->
                    <!-- INCISO C -->
                    <br><h6>B. Complete el siguiente cuadro relacionado con su educación y formación
                        academica: </h6>
                    <br>
                    <table class="table table-bordered">
                        <thead class="card-header text-center">
                        <tr>
                            <th>Educación</th>
                            <th>Años</th>
                            <th>Nombre de la institución</th>
                            <th>Titulo obtenido</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($educations as $education)
                            @if($education->level == 'Primaria')
                                <tr>
                                    <td>Primaria</td>
                                    <td><input type="text" class="form-control date" name="education_years[]"
                                               value="{{$education->time_education}}"></td>
                                    <td><input type="text" class="form-control" name="education_school_name[]"
                                               value="{{$education->school_name}}"></td>
                                    <td><input type="text" class="form-control" name="education_degree[]"
                                               value="{{$education->degree}}"></td>
                                </tr>
                            @endif
                            @if($education->level == 'Secundaria')
                                <tr>
                                    <td>Primaria</td>
                                    <td><input type="text" class="form-control date" name="education_years[]"
                                               value="{{$education->time_education}}"></td>
                                    <td><input type="text" class="form-control" name="education_school_name[]"
                                               value="{{$education->school_name}}"></td>
                                    <td><input type="text" class="form-control" name="education_degree[]"
                                               value="{{$education->degree}}"></td>
                                </tr>
                            @endif
                            @if($education->level == 'Universitaria')
                                <tr>
                                    <td>Primaria</td>
                                    <td><input type="text" class="form-control date" name="education_years[]"
                                               value="{{$education->time_education}}"></td>
                                    <td><input type="text" class="form-control" name="education_school_name[]"
                                               value="{{$education->school_name}}"></td>
                                    <td><input type="text" class="form-control" name="education_degree[]"
                                               value="{{$education->degree}}"></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                    <!-- INCISO C -->
                    <br><h6>D. Liste los seis conocimientos más importantes que usted posee de acuerdo a su
                        educación y al
                        puesto que aplica: </h6>
                    <br>
                    <div class="row">
                        @foreach($knowledges as $knowledge)
                            <div class="form-group col-md-6">
                                <input type="text" name="knowledge[]" class="form-control"
                                       value="{{$knowledge->description}}">
                            </div>
                        @endforeach
                    </div>

                    <!-- INCISO D -->
                    <br><h6>D. Enuncie las habilidades que posee y garantizan que cumplirá las actividades
                        requeridas por el
                        puesto que aplica: </h6>
                    <br>
                    <div class="row">
                        @foreach($skills as $skill)
                            <div class="form-group col-md-6">
                                <input type="text" name="skill[]" class="form-control"
                                       value="{{$skill->description}}">
                            </div>
                        @endforeach
                    </div>
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
                        @foreach($experiences_job as $experience)
                            <tr class="align-content-center align-items-md-center">
                                <td rowspan="4"><input type="text" class="form-control" name="company_name"
                                                       value="{{$experience->company_name}}"></td>
                                <td rowspan="4"><input type="text" class="form-control" name="position"
                                                       value="{{$experience->position}}"></td>
                                <td rowspan="4"><input type="text" class="form-control" name="worked_years"
                                                       value="{{$experience->experience_age}}">
                                </td>
                            </tr>
                        @endforeach
                        @foreach($activities as $activity)
                            <tr>
                                <td><input type="text" class="form-control" name="activity[]"
                                           value="{{$activity->description}}"></td>
                            </tr>
                        @endforeach

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
                        @foreach($economics as $economic)
                            <tr>
                                <td><input type="text" name="dependent_name[]" value="{{$economic->name}}"
                                           class="form-control"
                                    ></td>
                                <td><input type="text" name="dependent_relationship[]"
                                           value="{{$economic->relationship}}" class="form-control"
                                    ></td>
                                <td><input type="number" name="dependent_age[]" value="{{$economic->age}}"
                                           class="form-control"
                                    ></td>
                                <td><input type="text" name="dependent_address[]" value="{{$economic->address}}"
                                           class="form-control"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- INCISO B -->
                    <br><h6>B. Sueldo mínimo que aceptaria: </h6>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Lps</span>
                        </div>
                        <input type="number" class="form-control col-sm-4" name="minimun_salary"
                               value="{{$item->minimum_salary}}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>


                    <br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Lugar y fecha</label>
                            <input type="text" name="place_date" class="form-control"
                                   value="La Ceiba Atlantida, {{\Carbon\Carbon::now()->format('d \d\e m \d\e\l Y')}}">
                        </div>
                        <div class="form-group col">
                            <label for="" data-toggle="modal" data-target="#modal_firma">Firma
                            </label>
                            <div class="form-control align-items-center" id="contenedor_firma" style="height: 100px">
                                <img src="{{asset('uploades/' . $item->signature_path)}}" alt="" id="img-firma" width="100%" height="100%">
                            </div>
                            <input type="hidden" name="signature_paht" id="firma" value="">
                        </div>
                    </div>
                    <br><h6>Aprobada el {{\Carbon\Carbon::now()->format('d/m/Y')}}</h6>
                </form>
            </div>
        </div>
        <div class="card-body" id="main" style="display: block; ">
            <div class="float-right">
                <a href="#" id="edit" class="btn btn-primary">
                    Editar <i class="fas fa-pen-square"></i></a>
                <a href="{{ asset('uploades/5bae1bbe58a9918.xlsx') }}" target="_blank" class="btn btn-success">
                    Descargar <i class="fas fa-download"></i></a>
            </div>
        </div>
        <div class="card-body" style="display: none" id="second">
            <div class="float-right">
                <a href="#" id="cancel" class="btn btn-secondary">
                    Cancelar </a>
                <a href="#" class="btn btn-success" id="update">
                    Actualizar</a>

            </div>
        </div>
    </div>
    @break
@endforeach

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

<script>
    $(document).ready(function () {
        $("#edit").click(function (e) {
            e.preventDefault();
            $("#main").css('display', 'none');
            $("#second").css('display', 'block');
            readonly();
        });

        $("#cancel").click(function (e) {
            e.preventDefault();
            $("#second").css('display', 'none');
            $("#main").css('display', 'block');
            removeReadonly();
        });

        $("#update").click(function (e) {
            e.preventDefault();
            update();
        });

        function readonly() {
            $("#first_name").prop('readonly', true);
            $("#second_name").prop('readonly', true);
            $("#first_surname").prop('readonly', true);
            $("#second_surname").prop('readonly', true);
            $("#identity").prop('readonly', true);
            $("#email").prop('readonly', true);
        }

        function removeReadonly() {
            $("#first_name").removeAttr('readonly');
            $("#second_name").removeAttr('readonly');
            $("#first_surname").removeAttr('readonly');
            $("#second_surname").removeAttr('readonly');
            $("#identity").removeAttr('readonly');
            $("#email").removeAttr('readonly');
        }

        function update() {
            var path = '{{route('view_job_form.store')}}';
            var token = '{{csrf_token()}}';

            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#formulario").serialize(),
                success: function (data) {
                    if (data['status'] == true) {
                        $.notify("Se actualizo correctamente la solicitud de empleo", "success");
                        $("#contenido").load('{{route('view_job_form.index')}}');
                    } else {
                        $.notify("Tienes que solucionar unos problemas", "error");
                    }
                }
            });
        }
    })
</script>



