<script>
    $(document).ready(function () {
        $(".show").click(function (e) {
            e.preventDefault();
            var data_edit = $(this).data('edit');
            var path = 'teacher_user/' + data_edit + '/edit';
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: path,
                data: {'identity': data_edit},
                success: function (data) {
                    $("#first_name_e").attr("value", data[0]['first_name']);
                    $("#second_name_e").attr("value", data[0]['second_name']);
                    $("#first_surname_e").attr("value", data[0]['first_surname']);
                    $("#second_surname_e").attr("value", data[0]['second_surname']);
                    $("#identity_e").attr("value", data[0]['identity']);
                    $("#email_e").attr("value", data[0]['email']);
                    $("#modal_formulario_editar").modal('show');
                }
            })
        })
    })
</script>