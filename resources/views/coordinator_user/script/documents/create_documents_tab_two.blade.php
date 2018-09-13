<script>
    $(document).ready(function () {
        $("save_tab_two").click(function (e) {
            e.preventDefault();
            var ruta = '{{route('document.store')}}';
            var token = $("#token_uno").val();

            $.ajax({
                url: ruta,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#form_tab_one").serialize(),
                success: function (data) {
                    if (data['status'] == true) {
                        $("#contenido").load('{{route('document.index')}}')
                        $.notify("Se crearon correctamente la asignacion de documentos", "success")
                    } else {
                        $("#contenido").load('{{route('document.index')}}')
                        $.notify("No se crearon correctamente la asignacion de documentos", "error")
                    }
                },
                error: function (data) {
                    $("#contenido").load('{{route('document.index')}}')
                    $.notify("No se crearon correctamente la asignacion de documentos", "error")
                }
            })
        })
    })
</script>
