<script>
    $(document).ready(function () {
        $(".show").click(function (e) {
            e.preventDefault();
            var data_edit = $(this).data('edit');
            var path = 'faculty/' + data_edit + '/edit';
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: path,
                data: {'code': data_edit},
                success: function (data) {
                    $("#code_e").attr("value", data[0]['code']);
                    $("#name_e").attr("value", data[0]['name']);
                    $("#modal_formulario_editar").modal('show');
                }
            })
        })
    })
</script>