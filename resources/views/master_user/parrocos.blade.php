<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="fas fa-male"></i> Parrocos
    </div>
    <div class="card-body">
        <h4 class="page-header">
            <!-- Enlance decorado como boton, en data-target es importante que vaya el id del model
             meidante esto se va a invocar el modal que contienen el formulario cuando se de click en este enlace-->
            <a class="btn btn-primary" style="color: white;" data-toggle="modal"
               data-target="#modal_formulario">
                <i class="fas fa-plus"></i> Crear nueva Parroco
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
            @foreach($priests as $priest)
                <tr>
                    <td>{{$priest->id}}</td>
                    <td>{{$priest->name}}</td>
                    <td>
                        <a href="#" class="btn btn-success show" data-edit="{{$priest->id}}"><i
                                    class="far fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('master_user.modal.priest.create_priest')
@include('master_user.modal.priest.edit_priest')
{{--Script for datatable--}}
<script src="{{asset('js/tablas.js')}}"></script>
@include('master_user.scripts.priest.create_priest_script')
@include('master_user.scripts.priest.form_edit_priest_script')
@include('master_user.scripts.priest.edit_priest_script')