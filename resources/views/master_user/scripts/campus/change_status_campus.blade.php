<script>
    $(document).ready(function () {
        $("#table").on("click", ".status", function (e) {
            e.preventDefault();
            var campus_code = $(this).data('content');
            var status = $(this).data('status');
            var path = '{{route('change_status_campus')}}';
            var token = '{{csrf_token()}}'
            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: {'campus_code': campus_code, 'status': status},
                success: function (data) {
                    if (data['status'] == true) {
                        $("#contenido").load('{{route('campus.index')}}');
                        $('body').removeClass('modal-open');
                        $(".modal-backdrop").remove();
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