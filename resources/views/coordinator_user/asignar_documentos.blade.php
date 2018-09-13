<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="far fa-folder"></i> Asignar Documentos
    </div>
    <div class="card-body">
        <p>
            <a class="btn btn-primary" id="general" data-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" aria-controls="collapseExample">
                Solapa Uno
            </a>
            <button class="btn btn-primary" id="specific" type="button" data-toggle="collapse"
                    data-target="#collapseExample1"
                    aria-expanded="true" aria-controls="collapseExample">
                Solapa Dos
            </button>
        </p>
        <div class="collapse general" id="collapseExample">
            <div class="card card-body">

                <form action="#" method="post" id="formulario_solapa_uno">
                    <input type="hidden" value="{{csrf_token()}}" id="token_uno">
                    <input type="hidden" name="number_tab" value="1">
                    <div class="form-group">
                        <input type="text" name="tab[]" class="form-control"
                               placeholder="Ingrese el nombre del documento" required>
                    </div>
                    <div id="campos"></div>
                    <br>
                    <div class="float-right">
                        <button class="btn btn-primary" type="reset" id="add">Agregar</button>
                        <button class="btn btn-success" id="guardar-uno" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="collapse general" id="collapseExample1">
            <div class="card card-body">

                <form action="#" method="post" id="formulario_solapa_dos">
                    <input type="hidden" value="{{csrf_token()}}" id="token_dos">
                    <input type="hidden" name="number_tab" value="2" required>
                    <div class="form-group">
                        <input type="text" name="tab[]" class="form-control"
                               placeholder="Ingrese el nombre del documento">
                    </div>
                    <div id="campos-dos"></div>
                    <br>
                    <div class="float-right">
                        <button class="btn btn-primary" type="reset" id="add-dos">Agregar</button>
                        <button class="btn btn-success" type="submit" id="guardar-dos">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#add").click(function (e) {
            e.preventDefault();
            var campo = '<input type="text" name="tab[]" class="form-control"\n' +
                'placeholder="Ingrese el nombre del documento"><br>';

            $("#campos").append(campo);
        })
    })
</script>

<script>
    $(document).ready(function () {
        $("#guardar-uno").click(function (e) {
            e.preventDefault();
            var ruta = '{{route('documents.store')}}';
            var token = $("#token_uno").val();

            $.ajax({
                url: ruta,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#formulario_solapa_uno").serialize(),
                success: function (data) {
                    if (data['status'] == true) {
                        $("#contenido").load('{{route('documents.index')}}')
                        $.notify("Se crearon correctamente los campos de los documentos", "success")
                    } else {
                        $("#contenido").load('{{route('documents.index')}}')
                        $.notify("No se crearon correctamente los campos de los documentos", "error")
                    }
                },
                error: function (data) {
                    $("#contenido").load('{{route('documents.index')}}')
                    $.notify("No se crearon correctamente los campos de los documentos", "error")
                }
            })
        })
    })
</script>

<script>
    $(document).ready(function () {
        $("#add-dos").click(function (e) {
            e.preventDefault();
            var campo = '<input type="text" name="tab[]" class="form-control"\n' +
                'placeholder="Ingrese el nombre del documento"><br>';

            $("#campos-dos").append(campo);
        })
    })
</script>

<script>
    $(document).ready(function () {
        $("#guardar-dos").click(function (e) {
            e.preventDefault();
            var ruta = '{{route('documents.store')}}';
            var token = $("#token_dos").val();

            $.ajax({
                url: ruta,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#formulario_solapa_dos").serialize(),
                success: function (data) {
                    if (data['status'] == true) {
                        $("#contenido").load('{{route('documents.index')}}')
                        $.notify("Se crearon correctamente los campos de los documentos", "success")
                    } else {
                        $("#contenido").load('{{route('documents.index')}}')
                        $.notify("No se crearon correctamente los campos de los documentos", "error")
                    }
                },
                error: function (data) {
                    $("#contenido").load('{{route('documents.index')}}')
                    $.notify("No se crearon correctamente los campos de los documentos", "error")
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
