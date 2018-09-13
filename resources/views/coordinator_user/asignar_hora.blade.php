<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="far fa-clock"></i>Gestión de asignación de tiempo
    </div>
    <div class="card-body">
        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" id="general" aria-controls="collapseExample">
                General
            </a>
            <button class="btn btn-primary two" type="button" data-toggle="collapse"
                    data-target="#collapseExample1" id="specific"
                    aria-expanded="true" aria-controls="collapseExample">
                Especifica
            </button>
        </p>
        <div class="collapse general" id="collapseExample">
            <div class="card card-body">
                <form action="#" method="post" id="formulario_general">
                    <input type="hidden" value="{{csrf_token()}}" id="token_general">
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Facultad</label>
                            <select class="form-control formulario" id="faculty_coordinator" name="faculty_coordinator">
                                <option selected>[SELECCIONE UNA FACULTAD]</option>
                                @foreach($faculties_user as $faculty_user)
                                    <option value="{{$faculty_user->code}}">{{$faculty_user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Fecha</label>
                            <input type="text" name="datetimes" class="form-control"/>
                        </div>
                    </div>
                    <div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" id="cancelar">Cancelar</button>
                            <button type="button" class="btn btn-success" id="save">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="collapse personalizado" id="collapseExample1">
            <div class="card card-body">
                <form action="#" method="post" id="formulario_especifico">
                    <input type="hidden" value="{{csrf_token()}}" id="token_especifico">
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Facultad</label>
                            <select class="form-control formulario" name="faculty_coordinator" id="faculty_name">
                                <option selected>[SELECCIONE UNA FACULTAD]</option>
                                @foreach($faculties_user as $faculty_user)
                                    <option value="{{$faculty_user->code}}">{{$faculty_user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Fecha</label>
                            <input type="text" name="datetimes" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Listado de aspirantes/docentes de la facultad</label><br>
                        </div>
                    </div>
                    <div id="faculty_list">
                    </div>
                    <div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn btn-success" id="save_specific">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var start_date;
        var end_date;
        var faculty_coordinator;

        $(function () {
            $('input[name="datetimes"]').daterangepicker({
                opens: 'left',
                timePicker24Hour: true,
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour'),
                locale: {
                    format: 'DD-MM-YYYY HH:mm '
                }
            }, function (start, end, label) {
                start_date = start.format('YYYY-DD-MM H:mm');
                end_date = end.format('YYYY-DD-MM H:mm');
            });
        });

        $('select').on('change', function () {
            faculty_coordinator = (this.value);
        });

        $("#save").click(function () {
            setTimeGeneral(start_date, end_date, faculty_coordinator);
        });

        $("#save_specific").click(function () {
            setTimeParticulary(start_date, end_date);
        })

        function setTimeGeneral(start_date, end_date) {
            var path = '{{route('document_date.store')}}'
            var token = '{{csrf_token()}}'
            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: {'start_date': start_date, 'end_date': end_date, 'faculty_coordinator': faculty_coordinator},
                success: function (data) {
                    if (data['status'] == true) {
                        $.notify("Se asigno correctamente la fecha", "success");
                    }
                }
            });
        }

        function setTimeParticulary(start_date, end_date){
            var path = '{{route('document_date.store')}}'
            var token = '{{csrf_token()}}'
            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#formulario_especifico").serialize() + '&start_date=' + start_date + '&end_date=' + end_date,
                success: function (data) {
                    if (data['status'] == true) {
                        $.notify("Se asigno correctamente la fecha", "success");
                    }
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function () {
        $("#faculty_name").on('change', function () {
            var path = 'document_date/' + $(this).val() + '/edit';
            var token = '{{csrf_token()}}'
            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'get',
                dataType: 'json',
                data: {'d': 'moose'},
                success: function (data) {
                    if (data['status'] != null) {
                        $("#faculty_list").empty();
                        $.each(data['status'], function (index, element) {
                            $('#faculty_list').append(
                                '<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="custom-control-input" name="name[]"  id="' + element.id + '" value="' + element.id + '">' +
                                '<label class="custom-control-label" for="' + element.id + '">' + element.first_name + ' ' + element.second_name + ' ' + element.first_surname + ' ' + element.second_surname + '   </label>' +
                                '</div>'
                            );
                        });
                    }
                }
            })
        })
    })
</script>

<script>
    $("#general").click(function () {
        $("#collapseExample1").collapse('hide');
    })
</script>.

<script>
    $("#specific").click(function () {
        $("#collapseExample").collapse('hide');
    })
</script>
