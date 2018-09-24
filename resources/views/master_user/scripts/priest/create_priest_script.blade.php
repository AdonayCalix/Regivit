<script>
    $(document).ready(function () {
        $("#save").click(function () {
            var path = '{{route('priest.store')}}';
            var token = $("#token").val();

            $.ajax({
                url: path,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                dataType: 'json',
                data: $("#form").serialize(),
                success: function (data) {
                    if (data['status'] === true) {
                        $("#contenido").load('{{route('priest.index')}}')
                        $('body').removeClass('modal-open');
                        $(".modal-backdrop").remove();
                        $.notify("Se agrego correctamente el parroco", "success");
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