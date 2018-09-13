<script>
    $(document).ready(function () {
        $(".report").click(function (e) {
            e.preventDefault();
            var data_report = $(this).data('report');
            var path = 'report/' + data_report + '/edit';
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: path,
                data: {'identity': data_report},
                success: function (data) {
                    console.log(data)

                        $("#list li").append('<li>' + data[0]['name'] + '</li>');
                        $("#list li").append('<li>' + data[1]['name'] + '</li>');
                        $("#list li").append('<li>' + data[2]['name'] + '</li>');
                        $("#list li").append('<li>' + data[3]['name'] + '</li>');
                        $("#list li").append('<li>' + data[4]['name'] + '</li>');
                        $("#list li").append('<li>' + data[5]['name'] + '</li>');
                        $("#list li").append('<li>' + data[6]['name'] + '</li>');
                        $("#list li").append('<li>' + data[7]['name'] + '</li>');
                        $("#list li").append('<li>' + data[8]['name'] + '</li>');

                    $("#modal_reporte").modal('show');
                }
            })
        })
    })
</script>