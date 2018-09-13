
<script>
    $(document).ready(function () {
        $("#table").on("click", ".status", function (e) {
            e.preventDefault();
            var identity_data = $(this).data('content');
            var status = $(this).data('status');
            var path = '{{route('change_status')}}';
            var token = '{{csrf_token()}}'
            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: {'identity': identity_data, 'status': status},
                success: function (data) {
                    if (data['status'] == true) {
                        $("#contenido").load('{{route('master_user.index')}}')
                    } else {
                        $("#contenido").load('{{route('master_user.index')}}')
                    }
                    $.notify("Se cambio el estado correctamente", "success");
                },
                error: function (data) {
                    $.notify("No se cambio el estado del usuario correctamente", "error");
                }
            })
        })
    })
</script>