<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="fas fa-church"></i> Parroquias
    </div>
    <div class="card-body">
        <h4 class="page-header">
            <!-- Enlance decorado como boton, en data-target es importante que vaya el id del model
             meidante esto se va a invocar el modal que contienen el formulario cuando se de click en este enlace-->
            <a class="btn btn-primary" style="color: white;" data-toggle="modal"
               data-target="#modal_formulario">
                <i class="fa fa-plus"></i> Crear nueva Parroquia
            </a>
        </h4><br>
        <table class="table table-hover" id="table">
            <thead>
            <tr>
                <th>Número</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parishes as $parish)
                <tr>
                    <td>{{$parish->id}}</td>
                    <td>{{$parish->name}}</td>
                    <td>
                        <a href="#" class="btn btn-success show" data-edit="{{$parish->id}}"><i
                                    class="far fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('master_user.modal.parish.create_parish')
@include('master_user.modal.parish.edit_parish')
{{--Script for datatable--}}
<script src="{{asset('js/tablas.js')}}"></script>
@include('master_user.scripts.parish.create_parish_script')
@include('master_user.scripts.parish.form_edit_parish_script')
@include('master_user.scripts.parish.edit_parish_script')