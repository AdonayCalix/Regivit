<script>
    $(document).ready(function () {
        $(".show").click(function (e) {
            e.preventDefault();
            var data_edit = $(this).data('edit');
            var path = 'campus/' + data_edit + '/edit';
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: path,
                data: {'campus_code': data_edit},
                success: function (data) {
                    $("#campus_code_e").attr("value", data[0]['campus_code']);
                    $("#name_e").attr("value", data[0]['name']);
                    $("#city_e").attr("value", data[0]['city']);
                    $("#modal_formulario_editar").modal('show');
                }
            })
        })
    })
</script>