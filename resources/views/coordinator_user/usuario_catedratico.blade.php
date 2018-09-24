<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="far fa-user"></i> Usuarios Catedraticos
    </div>
    <div class="card-body">
        <h4 class="page-header">
            <!-- Enlance decorado como boton, en data-target es importante que vaya el id del model
             meidante esto se va a invocar el modal que contienen el formulario cuando se de click en este enlace-->
            <a class="btn btn-primary" style="color: white;" data-toggle="modal"
               data-target="#modal_formulario">
                <i class="fa fa-plus"></i> Crear nuevo catedratico
            </a>
        </h4><br>
        <table class="table table-hover" id="table">
            <thead>
            <tr>
                <th>Identidad</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Tipo de usuario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <td>{{$user->identity}}</td>
                    <td>{{$user->first_name . " " . $user->second_name}}</td>
                    <td>{{$user->first_surname . " " . $user->second_surname}}</td>
                    <td>Catedratico</td>
                    @if ($user->status === '1')
                        <td><a href="#" class="status"
                               data-content="{{$user->identity}}" data-status="1"><span
                                        class="badge badge-success">Activo</span></a></td>
                    @else
                        <td><a href="#" class="status"
                               data-content="{{$user->identity}}" data-status="2"><span
                                        class="badge badge-warning">Inactivo</span></a></td>
                    @endif
                    <td>
                        <a href="#" class="btn btn-primary report"
                           data-report="{{$user->id}}"><i
                                    class="fas fa-search-plus text-white"></i>
                        <a href="#" class="btn btn-success show"
                           data-edit="{{$user->identity}}"><i
                                    class="far fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('coordinator_user.modal.teacher.create_form')
@include('coordinator_user.modal.teacher.edit_teacher_modal')
@include('coordinator_user.modal.teacher.report_modal')


{{--Script Datatable--}}
<script src="{{asset('js/tablas.js')}}"></script>
@include('coordinator_user.script.teacher.create_teacher_script')
@include('coordinator_user.script.teacher.change_status_teacher_script')
@include('coordinator_user.script.teacher.form_edit_user_script')
@include('coordinator_user.script.teacher.edit_teacher_script')

<script>
    $(document).ready(function () {
        $(".report").click(function (e) {
            e.preventDefault();
            var data_report = $(this).data('report');
            var path = 'report/' + data_report + '/edit';
            var token = '{{csrf_token()}}';

            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'get',
                dataType: 'json',
                data: {'data_report': data_report},
                success: function (data) {
                    limpiar();
                    showInformation(data);
                    list_one(data);
                    list_two(data);
                    progress_one(data);
                    progress_two(data);
                },
                error: function (data) {

                }
            });
            $("#report_id").modal('show');
        });

        function limpiar() {
            $("#name").empty();
            $("#nacimiento").empty();
            $("#ingreso");
            $("#vehiculo");
            $("#pregado");
            $("#posgrado");
        }

        function progress_one(data) {
            $("#solapauno").empty();
            $("#info_one").empty();
            var total = data['total_count'];
            var total_subidos = data['count_uploades'];
            var porcentaje = Math.round((total_subidos/total)*100);
            console.log(porcentaje)
            $("#solapauno").css('width', porcentaje + '%');
            $("#solapauno").text(porcentaje + '%');
            $("#info_one").text(total_subidos + '/' + total + ' documentos');
        }

        function progress_two(data) {
            $("#solapados").empty()
            $("#info_two");
            var total = data['total_count2'];
            var total_subidos = data['count_uploades2'];
            var porcentaje = Math.round((total_subidos/total)*100);
            console.log(porcentaje)
            $("#solapados").css('width', porcentaje + '%');
            $("#solapados").text(porcentaje + '%');
            $("#info_two").text(total_subidos + '/' + total + ' documentos');
        }

        function showInformation(data) {
            $("#name").text(data['information_personal'][0]['first_name'] + ' ' + data['information_personal'][0]['second_name'] + ' ' + data['information_personal'][0]['first_surname'] + ' ' + data['information_personal'][0]['second_surname'])
            $("#nacimiento").text(data['information_personal'][0]['birthdate']);
            if(data['information_personal'][0]['admission_date'] == null) {
                $("#ingreso").text('No definida');
            } else {
                $("#ingreso").text(data['information_personal'][0]['admission_date']);
            }
            if(data['information_personal'][0]['vehiculo'] == 2){
                $("#vehiculo").text('No tiene');
            } else {
                $("#vehiculo").text(data['information_personal'][0]['marca_vehiculo'] + ' modelo: ' + data['information_personal'][0]['modelo_vehiculo'])
            }
            $("#pregado").text(data['information_personal'][0]['pregrado']);
            $("#posgrado").text(data['information_personal'][0]['postgrado'])
        }

        function list_one(data) {
            $("#list_one").empty();
            $.each(data['list_document'], function (index, element) {
                $("#list_one").append("<a href=\"preview/" + element.path + "\" class=\"link list-group-item report\">" + element.name + " " + "<i class=\"fas fa-download  float-right\"></i></a>");
            });
        }

        function list_two(data) {
            $("#list_two").empty();
            $.each(data['list_document_two'], function (index, element) {
                $("#list_two").append("<a href=\"preview/" + element.path + "\" class=\"link list-group-item\">" + element.name + " " + "<i class=\"fas fa-download  float-right\"></i></a>");
            });
        }
    });
</script>