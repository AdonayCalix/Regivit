<script>
    $(document).ready(function () {
        $("#table").on("click", ".status", function (e) {
            e.preventDefault();
            var code_faculty = $(this).data('content');
            var status = $(this).data('status');
            var path = '{{route('change_status_faculty')}}';
            var token = '{{csrf_token()}}'
            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: {'code_faculty': code_faculty, 'status': status},
                success: function (data) {
                    if (data['status'] == true) {
                        $("#contenido").load('{{route('faculty.index')}}');
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