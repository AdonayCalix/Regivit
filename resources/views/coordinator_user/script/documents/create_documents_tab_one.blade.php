<script>
    $(document).ready(function () {
        $("#save").click(function () {
            var path = '{{route('create_document')}}'
            var token = $("#token_uno").val();

            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#form-tab-one").serialize(),
                success: function (data) {
                    if (data['status'] == true) {
                        $("#modal_formulario").modal('hide');
                        $('body').removeClass('modal-open');
                        $(".modal-backdrop").remove();
                        $.notify("El usuario se creo exitosamente", "success");
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