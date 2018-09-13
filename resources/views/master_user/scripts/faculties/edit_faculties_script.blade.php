<script>
    $(document).ready(function () {
        $("#edit").click(function () {
            var path = '{{route('edit_faculty')}}';
            var token = $("#token").val();

            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#form_e").serialize(),
                success: function (data) {
                    if (data['status'] === true) {
                        $("#contenido").load('{{route('faculty.index')}}')
                        $('body').removeClass('modal-open');
                        $(".modal-backdrop").remove();
                        $.notify("Se actualizo correctamente la información del campus", "success");
                    }
                },
                error: function (data) {
                    $(".mensaje-error").find("ul").html('');

                    $(".mensaje-error").css('display', 'block');

                    $.each(data.responseJSON.errors, function (key, value) {

                        $(".mensaje-error").find("ul").append('<li>' + value + '</li>');

                    });
                    $.notify("Tienes que resolver algunos problemas", "error");
                }
            })

            $(".close").click(function () {
                $(".mensaje-error").css('display', 'none');
            })
        })
    })
</script>