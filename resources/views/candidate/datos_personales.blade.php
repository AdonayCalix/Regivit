<br><br>

<div class="card animated fadeIn">
    <div id="capture">
        <div class="card-header">
            <strong>REG-RH.120 Ficha de datos
                <personales></personales>
            </strong>
        </div>
        <div class="card-body">
            <!-- PORTADA DE REG-R.120-->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1 align-content-center align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/UNICAH_logo.png"
                         width="150" height="150"
                         alt="">
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
                                <small> *</small>
                            </label>
                            <input type="text" name="current_position" class="form-control"
                                   placeholder="Ingrese su puesto actual">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Primer Nombre
                                <small> *</small>
                            </label>
                            <input type="text" name="first_name" class="form-control"
                                   value="{{auth()->user()->first_name}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">Segundo Nombre
                                <small> *</small>
                            </label>
                            <input type="text" name="second_name" class="form-control"
                                   placeholder="Ingrese su segundo nombre"
                                   value="{{auth()->user()->second_name}}" readonly>
                        </div>
                    </div>
                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Primer Apellido
                                <small> *</small>
                            </label>
                            <input type="text" name="first_surname" class="form-control"
                                   placeholder="Ingrese su primer apellido"
                                   value="{{auth()->user()->first_surname}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">Segundo Apellido
                                <small> *</small>
                            </label>
                            <input type="text" name="second_surname" class="form-control"
                                   placeholder="Ingrese su segundo apellido"
                                   value="{{auth()->user()->second_surname}}" readonly>
                        </div>
                    </div>

                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Estado Civil
                                <small> *</small>
                            </label>
                            <select class="form-control formulario" name="civil_status" readonly="true">
                                <option value="Una burrada">{{$value['civil_status']}}</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Identidad
                                <small> *</small>
                            </label>
                            <input type="text" name="identity" class="form-control"
                                   value="{{auth()->user()->identity}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">Fecha de Nacimiento
                                <small> *</small>
                            </label>
                            <input type="date" name="birthdate" class="form-control"
                                   value="{{$value['birthdate']}}" readonly>
                        </div>
                    </div>

                    <!-- Bloque -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Dirección actual
                                <small> *</small>
                            </label>
                            <input type="text" name="address" class="form-control"
                                   value="{{$value['address']}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">E-mail
                                <small> *</small>
                            </label>
                            <input type="text" name="email" class="form-control"
                                   value="{{auth()->user()->email}}" readonly>
                        </div>
                    </div>

                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Telefono casa
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="telefono_casa"
                                   placeholder="Telefono casa...">
                        </div>
                        <div class="form-group col">
                            <label for="">Telefono oficina
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="telefono_oficina"
                                   placeholder="Telefono oficina...">
                        </div>
                        <div class="form-group col">
                            <label for="">Telefono otros
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="telefono_otro"
                                   placeholder="Telefono otros">
                        </div>
                        <div class="form-group col">
                            <label for="">Nacionalidad
                                <small> *</small>
                            </label>
                            <select class="form-control formulario" name="nacionalidad" readonly="true">
                                <option readonly>{{$value['nationality']}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($degree_education as $degrees)
                            @if($degrees->level == 'Primaria')
                                <div class="form-group col">
                                    <label for="">Grado Académico Primaria
                                        <small> *</small>
                                    </label>
                                    <input type="text" name="primary_education" class="form-control"
                                           value="{{$degrees->degree}}" readonly>
                                </div>
                            @endif
                            @if($degrees->level == 'Secundaria')
                                <div class="form-group col">
                                    <label for="">Grado Académico Secundaria
                                        <small> *</small>
                                    </label>
                                    <input type="text" name="high_school_education" class="form-control"
                                           value="{{$degrees->degree}}" readonly>
                                </div>
                            @endif
                            @if($degrees->level == 'Universitaria')
                                <div class="form-group col">
                                    <label for="">Académimco Universitaria
                                        <small> *</small>
                                    </label>
                                    <input type="text" name="university_education" class="form-control"
                                           value="{{$degrees->degree}}" readonly>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group col">
                            <label for="">Grado Académico Postgrado
                                <small> *</small>
                            </label>
                            <input type="text" name="postgrade_education" class="form-control"
                                   placeholder="Ingresa el Postgrado que tengas">
                        </div>
                    </div>

                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">IHSS</label>
                            <input type="text" class="form-control" name="ihss"
                                   value="{{$value['ihss']}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">RAP/FOSOVI</label>
                            <input type="text" class="form-control" name="rap_fosovi"
                                   value="{{$value['rap']}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">N° de Colegio Profesional</label>
                            <input type="text" class="form-control" name="personal_school_number"
                                   placeholder="Número de colegio profesional...">
                        </div>
                        <div class="form-group col">
                            <label for="">N° Licencia de Conducir</label>
                            <input type="text" class="form-control" name="driver_license"
                                   placeholder="Número de colegio profesional...">
                        </div>
                    </div>
                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Carnet de trabajo</label>
                            <input type="text" class="form-control" name="job_card"
                                   placeholder="Número de carnet de trabajo...">
                        </div>
                        <div class="form-group col">
                            <label for="">Fecha de ingreso</label>
                            <input type="date" class="form-control" name="admission_date"
                                   placeholder="Ingrese la fecha...">
                        </div>
                        <div class="form-group col">
                            <label for="">N° cuenta BAMER</label>
                            <input type="text" class="form-control" name="bamer_account_number"
                                   placeholder="Número de cuenta BAMER...">
                        </div>
                        <div class="form-group col">
                            <label for="">Campus que labora
                                <small> *</small>
                            </label>
                            <select class="form-control formulario" name="campus_id">
                                <option value="">[Seleccione]</option>
                                @foreach($campus as $campu)
                                    <option value="{{$campu->id}}">{{$campu->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Posee movil</label>
                            <select class="form-control formulario" id="has_car" name="has_car">
                                <option value="">[Seleccione]</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>

                        </div>
                        <div class="form-group col">
                            <label for="">Marca</label>
                            <input type="text" class="form-control car" name="marca"
                                   placeholder="Ingrese la marca...">
                        </div>
                        <div class="form-group col">
                            <label for="">Modelo</label>
                            <input type="text" class="form-control car" name="modelo"
                                   placeholder="Ingrese el modelo...">
                        </div>
                        <div class="form-group col">
                            <label for="">Año</label>
                            <input type="text" class="form-control car" name="anio"
                                   placeholder="Ingrese el modelo...">
                        </div>
                    </div>

                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Nombre de Conyuge</label>
                            <input type="text" class="form-control" name="spouse_name"
                                   placeholder="Ingrese el nombre del conyuge...">
                        </div>
                        <div class="form-group col">
                            <label for="">En caso de emergencia avisar a
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="emergency"
                                   placeholder="Ingrese el nombre de la persona a llamar en caso de emergencia...">
                        </div>
                        <div class="form-group col">
                            <label for="">Telefono de la persona a avisar
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="emergency_number"
                                   placeholder="Ingrese el número de la persona a avisar...">
                        </div>
                    </div>
                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Parroquia a la que asiste
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="parish"
                                   value="{{$value['parish']}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">Nombre del Párroco
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="priest"
                                   value="{{$value['priest']}}" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="">Movimiento Cristiano
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="catholic_movement"
                                   value="{{$value['catholic_movement']}}" readonly>
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
                        @foreach($dependets as $dependent)
                            <tr>
                                <td><input type="text" name="nombre_parenteso[]" class="form-control"
                                           value="{{{$dependent->name}}}"></td>
                                <td><input type="text" name="tipo_parentesco[]" class="form-control"
                                           value="{{$dependent->relationship}}"></td>
                                <td><input type="date" name="fecha_nacimiento_parentesco[]"
                                           class="form-control">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <br>

                    </table>

                    <!-- BLOQUE -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="" data-toggle="modal" data-target="#modal_firma"><strong>Firma (De click aqui)
                                </strong></label><br>
                            <div class="form-control align-content-center" id="contenedor_firma"
                                 style="height: 100px">
                                <img src="" alt="" id="img-firma" width="100%" height="100%">
                            </div>
                            <input type="hidden" name="signature_path" id="firma" value="soylafirma">
                        </div>
                        <div class="form-group col">
                            <label for="">Fecha
                                <small> *</small>
                            </label>
                            <input type="text" class="form-control" name="current_date"
                                   value="{{\Carbon\Carbon::now()->format('d-m-Y')}}"
                                   placeholder="{{\Carbon\Carbon::now()->format('d-m-Y')}}" readonly>
                        </div>
                    </div>
                    @break
                @endforeach
                <div class="float-right">
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                    <button type="button" id="crear" class="btn btn-success">Guardar</button>
                </div>
            </form>
            <br><br>
            <div class="alert alert-danger mensaje-error" style="display:none">
                <ul></ul>
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
        $("#crear").click(function () {
            var ruta = '{{route('personal_data_form.store')}}';
            var token = $("#token").val();

            $.ajax({
                url: ruta,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#formulario").serialize(),
                success: function (data) {
                    if (data['status'] == true) {
                        createDocument();
                        $.notify("Se guardaron los datos correctamente", "success");
                        $("#contenido").load('{{route('view_personal.index')}}')
                    } else {
                        $.notify("No se guardaron los datos correctamente", "error");
                    }
                },
                error: function (data) {
                    $(".mensaje-error").find("ul").html('');

                    $(".mensaje-error").css('display', 'block');

                    $.each(data.responseJSON.errors, function (key, value) {

                        $(".mensaje-error").find("ul").append('<li>' + value + '</li>');

                    });
                    $.notify("Tienes que resolver algunos problemas", "error");
                }
            })
        })
    });

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
</script>

<script>
    $(document).ready(function () {
        $('#has_car').on('change', function () {
            if ($(this).val() == 2) {
                $(".car").attr('readonly', 'true');
            } else {
                $(".car").removeAttr('readonly', 'true');
            }
        })
    })
</script>
