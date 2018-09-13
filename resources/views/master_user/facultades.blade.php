<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="fas fa-university"></i> Facultades
    </div>
    <div class="card-body">
        <h4 class="page-header">
            <!-- Enlance decorado como boton, en data-target es importante que vaya el id del model
             meidante esto se va a invocar el modal que contienen el formulario cuando se de click en este enlace-->
            <a class="btn btn-primary" style="color: white;" data-toggle="modal"
               data-target="#modal_formulario">
                <i class="fa fa-plus"></i> Crear nueva facultad
            </a>
        </h4><br>
        <table class="table table-hover" id="table">
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($faculties as $faculty)
                <tr>
                    <td>{{$faculty->code}}</td>
                    <td>{{$faculty->name}}</td>
                    @if ($faculty->status == 1)
                        <td><a href="#" class="status"
                               data-content="{{$faculty->code}}" data-status="1"><span
                                        class="badge badge-success">Activo</span></a>
                    @else
                        <td><a href="#" class="status"
                               data-content="{{$faculty->code}}" data-status="2"><span
                                        class="badge badge-warning">Inactivo</span></a>
                    @endif
                    <td>
                        <a href="#" class="btn btn-success show" data-edit="{{$faculty->code}}"><i
                                    class="far fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

{{--Modal to show the create form--}}
@include('master_user.modal.faculties.create_faculties')
{{--MOdal for edit Faculty--}}
@include('master_user.modal.faculties.edit_faculties')
<!-- Llamado de la funcion tabla.js, encargada de ejecutar el metodo DataTable para la visualización dinamica de las tablas -->
<script src="{{asset('js/tablas.js')}}"></script>
{{--Script for change status of faculty--}}
@include('master_user.scripts.faculties.change_status_faculties')
{{--Script for create faculty--}}
@include('master_user.scripts.faculties.create_faculties_script')
{{--Script for edit faculty--}}
@include('master_user.scripts.faculties.edit_faculties_script')
{{--Show modal for edit Faculty--}}
@include('master_user.scripts.faculties.form_edit_faculties_script')
