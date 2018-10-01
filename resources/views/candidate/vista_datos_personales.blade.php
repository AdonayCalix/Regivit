<br>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong>Ya has llenado este formulario</strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@foreach($personal_datas as $personal_data)
    <div class="card animated fadeIn">
        <div id="capture">
            <div class="card-header">
                <strong>REG-RH.120 Ficha de datos personales
                </strong>
            </div>
            <div class="card-body">
                <!-- PORTADA DE REG-R.120-->
                <div class="row">
                    <div class="col-md-3 align-items-center">
                        <div class="row justify-content-end">
                            <br>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/UNICAH_logo.png"
                                height="80%" width="50%" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 text-center font-weight-bold">
                        <br><h5>UNIVERSIDAD CATÓLICA DE HONDURAS</h5>
                        <h5>"NUESTRA SEÑORA REINA DE LA PAZ"</h5>
                        <br>
                        <h5>FICHA DE DATOS PERSONALES</h5>
                    </div>

                </div>
                <br>

                <div class="card-header"><br></div>
                <!-- Formulario -->
                <form action="#" method="post" id="formulario">
                    <input type="hidden" id="token" value="{{csrf_token()}}">
                    <!-- ENCABEZADO-->
                    <br><br>
                    @foreach($values as $value)
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Puesto actual

                                </label>
                                <input type="text" name="current_position" class="form-control"
                                       value="{{$personal_data->current_position}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Primer Nombre

                                </label>
                                <input type="text" name="first_name" class="form-control"
                                       id="first_name" value="{{auth()->user()->first_name}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Segundo Nombre

                                </label>
                                <input type="text" name="second_name" class="form-control"
                                       placeholder="Ingrese su segundo nombre"
                                       id="second_name" value="{{auth()->user()->second_name}}">
                            </div>
                        </div>
                        <!-- Bloque -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Primer Apellido

                                </label>
                                <input type="text" name="first_surname" class="form-control"
                                       placeholder="Ingrese su primer apellido"
                                       id="first_surname" value="{{auth()->user()->first_surname}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Segundo Apellido

                                </label>
                                <input type="text" name="second_surname" class="form-control"
                                       placeholder="Ingrese su segundo apellido"
                                       id="second_surname" value="{{auth()->user()->second_surname}}">
                            </div>
                        </div>

                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Estado Civil

                                </label>
                                <select class="form-control formulario" name="civil_status" id="civil_status">
                                    <option value="">{{$value['civil_status']}}</option>
                                </select>
                            </div>
                            <div class="|form-group col">
                                <label for="">Identidad

                                </label>
                                <input type="text" name="identity" class="form-control"
                                       value="{{auth()->user()->identity}}" id="identity">
                            </div>
                            <div class="form-group col">
                                <label for="">Fecha de Nacimiento

                                </label>
                                <input type="date" name="birthdate" class="form-control"
                                       value="{{$value['birthdate']}}" id="birthdate">
                            </div>
                        </div>

                        <!-- Bloque -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Dirección actual

                                </label>
                                <input type="text" name="address" class="form-control"
                                       value="{{$value['address']}}" id="address">
                            </div>
                            <div class="form-group col">
                                <label for="">E-mail

                                </label>
                                <input type="text" name="email" class="form-control"
                                       value="{{auth()->user()->email}}" id="email">
                            </div>
                        </div>

                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Telefono casa

                                </label>
                                <input type="text" class="form-control" name="telefono_casa"
                                       value="{{$personal_data->telefono_casa}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Telefono oficina

                                </label>
                                <input type="text" class="form-control" name="telefono_oficina"
                                       value="{{$personal_data->telefono_oficina}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Telefono otros

                                </label>
                                <input type="text" class="form-control" name="telefono_otro"
                                       value="{{$personal_data->telefono_otro}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Nacionalidad

                                </label>
                                <select class="form-control formulario" name="nacionalidad" id="nationality">
                                    <option>{{$value['nationality']}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($degree_education as $degrees)
                                @if($degrees->level == 'Primaria')
                                    <div class="form-group col">
                                        <label for="">Grado Académico Primaria

                                        </label>
                                        <input type="text" name="primary_education" class="form-control"
                                               id="primary_education"
                                               value="{{$degrees->degree}}">
                                    </div>
                                @endif
                                @if($degrees->level == 'Secundaria')
                                    <div class="form-group col">
                                        <label for="">Grado Académico Secundaria

                                        </label>
                                        <input type="text" name="high_school_education" class="form-control"
                                               id="high_school_education"
                                               value="{{$degrees->degree}}">
                                    </div>
                                @endif
                                @if($degrees->level == 'Universitaria')
                                    <div class="form-group col">
                                        <label for="">Académimco Universitaria

                                        </label>
                                        <input type="text" name="university_education" class="form-control"
                                               id="university_education"
                                               value="{{$degrees->degree}}">
                                    </div>
                                @endif
                            @endforeach
                            <div class="form-group col">
                                <label for="">Grado Académico Postgrado

                                </label>
                                <input type="text" name="postgrade_education" class="form-control"
                                       value="{{$personal_data->postgrado}}">
                            </div>
                        </div>

                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">IHSS</label>
                                <input type="text" class="form-control" name="ihss" id="ihss"
                                       value="{{$value['ihss']}}">
                            </div>
                            <div class="form-group col">
                                <label for="">RAP/FOSOVI</label>
                                <input type="text" class="form-control" name="rap_fosovi" id="rap"
                                       value="{{$value['rap']}}">
                            </div>
                            <div class="form-group col">
                                <label for="">N° de Colegio Profesional</label>
                                <input type="text" class="form-control" name="personal_school_number"
                                       value="{{$personal_data->personal_school_number}}">
                            </div>
                            <div class="form-group col">
                                <label for="">N° Licencia de Conducir</label>
                                <input type="text" class="form-control" name="driver_license"
                                       value="{{$personal_data->driver_license}}">
                            </div>
                        </div>
                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Carnet de trabajo</label>
                                <input type="text" class="form-control" name="job_card"
                                       value="{{$personal_data->job_card}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Fecha de ingreso</label>
                                <input type="date" class="form-control" name="admission_date"
                                       value="{{$personal_data->admission_date}}">
                            </div>
                            <div class="form-group col">
                                <label for="">N° cuenta BAMER</label>
                                <input type="text" class="form-control" name="  "
                                       value="{{$personal_data->bamer_account_numer}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Campus que labora

                                </label>
                                <select class="form-control formulario" name="campus_id" id="campus">
                                    <option value="">[Seleccione]</option>
                                    @foreach($campus as $campu)
                                        <option selected value="{{$campu->id}}">{{$campu->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Posee movil</label>
                                <select class="form-control formulario" id="has_car" name="has_car">
                                    @if($personal_data->vehiculo == 1)
                                        <option value="1">Si</option>
                                    @else
                                        <option value="2">No</option>
                                    @endif
                                </select>

                            </div>
                            <div class="form-group col">
                                <label for="">Marca</label>
                                <input type="text" class="form-control car" name="marca"
                                       value="{{$personal_data->marca_vehiculo}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Modelo</label>
                                <input type="text" class="form-control car" name="modelo"
                                       value="{{$personal_data->modelo_vehiculo}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Año</label>
                                <input type="text" class="form-control car" name="anio"
                                       value="{{$personal_data->anio_vehiculo}}">
                            </div>
                        </div>

                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Nombre de Conyuge</label>
                                <input type="text" class="form-control" name="spouse_name"
                                       value="{{$personal_data->spouse_name}}">
                            </div>
                            <div class="form-group col">
                                <label for="">En caso de emergencia avisar a

                                </label>
                                <input type="text" class="form-control" name="emergency"
                                       value="{{$personal_data->emergency}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Telefono de la persona a avisar

                                </label>
                                <input type="text" class="form-control" name="emergency_number"
                                       value="{{$personal_data->emergency_number}}">
                            </div>
                        </div>
                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Parroquia a la que asiste

                                </label>
                                <input type="text" class="form-control" name="parish" id="parish"
                                       value="{{$value['parish']}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Nombre del Párroco

                                </label>
                                <input type="text" class="form-control" name="priest" id="priest"
                                       value="{{$value['priest']}}">
                            </div>
                            <div class="form-group col">
                                <label for="">Movimiento Cristiano

                                </label>
                                <input type="text" class="form-control" name="catholic_movement" id="catholic_movement"
                                       value="{{$value['catholic_movement']}}">
                            </div>
                        </div>

                        <!-- BLOQUE -->
                        <table class="table table-condensed table-bordered">
                            <thead class="card-header text-center">
                            <tr>
                                <th>Nombre</th>
                                <th>Parentesco</th>
                                <th>Fecha de Nacimiento</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dependents as $dependent)
                                <tr>
                                    <td><input type="text" name="nombre_parenteso[]" class="form-control"
                                               value="{{{$dependent->name}}}"></td>
                                    <td><input type="text" name="tipo_parentesco[]" class="form-control"
                                               value="{{$dependent->relationship}}"></td>
                                    <td><input type="date" name="fecha_nacimiento_parentesco[]"
                                               class="form-control" value="{{$dependent->birthdate}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <br>

                        </table>

                        <!-- BLOQUE -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="" data-toggle="modal" data-target="#modal_firma">Firma
                                </label><br>
                                <div class="form-control align-content-center" id="contenedor_firma"
                                     style="height: 100px">
                                    <img src="{{asset('uploades/' . $personal_data->signature_path)}}" alt="" id="img-firma" width="100%" height="100%">
                                </div>
                                <input type="hidden" name="signature_path" id="firma" value="default">
                            </div>
                            <div class="form-group col">
                                <label for="">Fecha

                                </label>
                                <input type="text" class="form-control" name="current_date"
                                       value="{{\Carbon\Carbon::now()->format('d-m-Y')}}"
                                       placeholder="{{\Carbon\Carbon::now()->format('d-m-Y')}}">
                            </div>
                        </div>
                        @break
                    @endforeach
                </form>
            </div>
        </div>
        <div class="card-body" id="main" style="display: block; ">
            <div class="float-right">
                <a href="#" id="edit" class="btn btn-primary">
                    Editar <i class="fas fa-pen-square"></i></a>
                <a href="{{ asset('uploades/' . $path_personal_data_form ) }}" target="_blank" class="btn btn-success">
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
            minWidth: 0.4,
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

        checkIf();

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
            $("#address").prop('readonly', true);
            $("#civil_status").attr('readonly', true);
            $("#email").prop('readonly', true);
            $("#birthdate").prop('readonly', true);
            $("#primary_education").prop('readonly', true);
            $("#high_school_education").prop('readonly', true);
            $("#university_education").prop('readonly', true);
            $("#university_education").prop('readonly', true);
            $("#nationality").attr('readonly', true);
            $("#ihss").prop('readonly', true);
            $("#rap").prop('readonly', true);
            $("#campus").attr('readonly', true);
            $("#parish").prop('readonly', true);
            $("#priest").prop('readonly', true);
            $("#catholic_movement").prop('readonly', true);
        }

        function removeReadonly() {
            $("#first_name").removeAttr('readonly');
            $("#second_name").removeAttr('readonly');
            $("#first_surname").removeAttr('readonly');
            $("#second_surname").removeAttr('readonly');
            $("#identity").removeAttr('readonly');
            $("#address").removeAttr('readonly');
            $("#civil_status").removeAttr('readonly');
            $("#email").removeAttr('readonly');
            $("#birthdate").removeAttr('readonly');
            $("#primary_education").removeAttr('readonly');
            $("#high_school_education").removeAttr('readonly');
            $("#university_education").removeAttr('readonly');
            $("#university_education").removeAttr('readonly');
            $("#nationality").removeAttr('readonly');
            $("#ihss").removeAttr('readonly');
            $("#rap").removeAttr('readonly');
            $("#campus").removeAttr('readonly');
            $("#parish").removeAttr('readonly');
            $("#priest").removeAttr('readonly');
            $("#catholic_movement").removeAttr('readonly');
        }

        function update() {
            var path = '{{route('view_personal.store')}}';
            var token = '{{csrf_token()}}';

            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#formulario").serialize(),
                success: function (data) {
                    if (data['status'] == true) {
                        createDocument();
                        $.notify("Se actualizo correctamente la ficha de datos personales", "success");
                        $("#contenido").load('{{route('view_personal.index')}}');
                    } else {
                        $.notify("Tienes que solucionar unos problemas", "error");
                    }
                }
            });
        }

        function createDocument() {
            var token = '{{csrf_token()}}';
            $.ajax({
                url: '{{route('screen_save_personal')}}',
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    console.log("Funciona");
                },
            });
        }

        function checkIf() {
            var path = '{{route('check_if_exit_personal_data_form')}}';

            $.ajax({
                url: path,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    if (data['status'] == true) {
                        console.log("Ya existe un archivo");
                    } else {
                        createDocument();
                        console.log("No existe aun un archivo, bueno antes no pero ahora si");
                    }
                }
            });
        }
    });
</script>
