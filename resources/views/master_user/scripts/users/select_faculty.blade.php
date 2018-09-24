<script>
    $(document).ready(function () {
        $('#user_type').on('change', function () {
            if ($(this).val() == 2) {
                $("#faculty").css('display', 'block');
            } else {
                $("#faculty").css('display', 'none');
            }
        });

        $(document).ready(function () {
            $('#user_type').on('change', function () {
                if ($(this).val() == 3 || $(this).val() == 4) {
                    $("#faculty_user").css('display', 'block');
                } else {
                    $("#faculty_user").css('display', 'none');
                }
            })
        })
    })
</script>