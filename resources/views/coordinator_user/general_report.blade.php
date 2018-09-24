<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="fas fa-clipboard"></i> Reporte General
    </div>
    <div class="card-body">
        <table class="table table-hover" id="table">
            <thead>
            <tr>
                <th>Identidad</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Facultad</th>
                <th>Porcentaje</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>

            @foreach($list_users as $list_user)
                <tr>
                    <td>{{$list_user->identity}}</td>
                    <td>{{$list_user->first_name . " " . $list_user->second_name}}</td>
                    <td>{{$list_user->first_surname . " " . $list_user->second_surname}}</td>
                    <td>Catedratico</td>
                    <td>{{$list_user->nombre_facultad}}</td>
                    <td>{{$list_user->porcentaje . " %"}}</td>
                    @if($list_user->porcentaje == 100){
                        <td>Completado</td>
                    @else
                        <td>Incompleto</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    title: 'Listado de Usuarios con porcentaje de completación de documentos',
                    orientation: 'vertical',
                    pageSize: 'A4'
                }
            ],
            "searching": false,
            "paginate": false,
            "info": false
        } );
    } );
</script>