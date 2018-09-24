<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="fas fa-university"></i> Campus
    </div>
    <div class="card-body">
        <h4 class="page-header">
            <!-- Enlance decorado como boton, en data-target es importante que vaya el id del model
             meidante esto se va a invocar el modal que contienen el formulario cuando se de click en este enlace-->
            <a class="btn btn-primary" style="color: white;" data-toggle="modal"
               data-target="#modal_formulario">
                <i class="fa fa-plus"></i> Crear nuevo campus
            </a>
        </h4><br>
        <table class="table table-hover" id="table">
            <thead>
            <tr>
                <th>N°</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>Opcion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($campus as $campu)
                <tr>
                    <td>{{$campu->id}}</td>
                    <td>{{$campu->campus_code}}</td>
                    <td>{{$campu->name}}</td>
                    <td>{{$campu->city}}</td>
                    @if ($campu->status == 1)
                        <td><a href="#" class="status"
                               data-content="{{$campu->campus_code}}" data-status="1"><span
                                        class="badge badge-success">Activo</span></a>
                        </td>
                    @else
                        <td><a href="#" class="status"
                               data-content="{{$campu->campus_code}}" data-status="2"><span
                                        class="badge badge-warning">Inactivo</span></a>
                        </td>
                    @endif

                    <td>
                        <a href="#" class="btn btn-success show" data-edit="{{$campu->campus_code}}"><i
                                    class="far fa-edit"></i></a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--Modal for create campus --}}
@include('master_user.modal.campus.create_campus')
{{--Modal for create campus --}}
@include('master_user.modal.campus.edit_campus')
<!-- Llamado de la funcion tabla.js, encargada de ejecutar el metodo DataTable para la visualización dinamica de las tablas -->
<script src="{{asset('js/tablas.js')}}"></script>
{{--Script for create campus--}}
@include('master_user.scripts.campus.create_campus_script')
{{--Script for change campus--}}
@include('master_user.scripts.campus.change_status_campus')
{{--Script for show modal edit--}}
@include('master_user.scripts.campus.form_edit_campus_script')
{{--Script for show modal edit--}}
@include('master_user.scripts.campus.edit_campus_script')



