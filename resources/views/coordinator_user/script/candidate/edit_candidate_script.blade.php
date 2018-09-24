<script>
    $(document).ready(function () {
        $("#edit").click(function () {
            var path = '{{route('edit_user_candidate')}}';
            var token = $("#token_e").val();

            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#form_e").serialize(),
                success: function (data) {
                    if (data['status'] === true) {
                        $("#modal_formulario_editar").modal('hide');
                        $('body').removeClass('modal-open');
                        $(".modal-backdrop").remove();
                        $("#contenido").load('{{route('candidate_user.index')}}');
                        $.notify("El usuario se actualizo correctamente", "success");
                    }
                },
                error: function (data) {
                    $(".mensaje-error").find("ul").html('');

                    $(".mensaje-error").css('display', 'block');

                    $.each(data.responseJSON.errors, function (key, value) {

                        $(".mensaje-error").find("ul").append('<li>' + value + '</li>');

                    });
                    $.notify("El usuario no se creo exitosamente", "error");
                }
            })

            $(".close").click(function () {
                $(".mensaje-error").css('display', 'none');
            })
        })
    })
</script>
