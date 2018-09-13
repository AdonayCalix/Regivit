<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="far fa-user"></i> Usuarios
    </div>
    <div class="card-body">
        <h4 class="page-header">
            <!-- Enlance decorado como boton, en data-target es importante que vaya el id del model
             meidante esto se va a invocar el modal que contienen el formulario cuando se de click en este enlace-->
            <a class="btn btn-primary" style="color: white;" data-toggle="modal"
               data-target="#modal_formulario">
                <i class="fa fa-plus"></i> Crear nuevo usuario
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

            @foreach ($users as $user)
                <tr>
                    <td>{{$user->identity}}</td>
                    <td>{{$user->first_name . " " . $user->second_name}}</td>
                    <td>{{$user->first_surname . " " . $user->second_surname}}</td>
                    <td>
                        @switch($user->user_type)
                            @case('1')
                                {{'Maestro'}}
                                @break
                            @case('2')
                                {{'Coordinador'}}
                                @break
                            @case('3')
                                {{'Aspirante'}}
                                @break
                            @case('4')
                                {{'Catedratico'}}
                                @break
                        @endswitch
                    </td>
                    @if ($user->status == 1)
                        <td><a href="#" class="status"
                               data-content="{{$user->identity}}" data-status="1"><span
                                        class="badge badge-success">Activo</span></a></td>
                    @else
                        <td><a href="#" class="status"
                               data-content="{{$user->identity}}" data-status="2"><span
                                        class="badge badge-warning">Inactivo</span></a></td>
                    @endif
                    <td>
                        <a href="#" class="btn btn-success show" data-edit="{{$user->identity}}"><i
                                    class="far fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--View of create user form within of a modal--}}
@include('master_user.modal.users.create_form')
{{--View of edit user form within of a modal--}}
@include('master_user.modal.users.edit_master_modal')
{{-- Script for create users--}}
@include('master_user.scripts.users.create_user_script')
{{-- Script for show user information--}}
@include('master_user.scripts.users.form_edit_user_script')
{{-- Script for change user status--}}
@include('master_user.scripts.users.change_status_user_script')
{{-- Script for change user status--}}
@include('master_user.scripts.users.edit_user_script')
{{--Script for choose one o many faculties to corrdinator users--}}
@include('master_user.scripts.users.select_faculty')
{{-- Scripts --}}
<script src="{{asset('js/tablas.js')}}"></script>


