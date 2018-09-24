<script>
    $(document).ready(function () {
        $(".show").click(function (e) {
            e.preventDefault();
            var data_edit = $(this).data('edit');
            var path = 'priest/' + data_edit + '/edit';
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: path,
                data: {'priest_id': data_edit},
                success: function (data) {
                    $("#id_e").attr("value", data[0]['id']);
                    $("#name_e").attr("value", data[0]['name']);
                    $("#modal_formulario_editar").modal('show');
                }
            })
        })
    })
</script>