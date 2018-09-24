<script>
    $(document).ready(function () {
        $("#add").click(function (e) {
            e.preventDefault();
            var field = '<input type="text" name="tab[]" class="form-control"\n' +
                'placeholder="Ingrese el nombre del documento"><br>';

            $("#campos").append(field);
        })
    })
</script>

<script>
    $(document).ready(function () {
        $("#add-second").click(function (e) {
            e.preventDefault();
            var field = '<input type="text" name="tab[]" class="form-control"\n' +
                'placeholder="Ingrese el nombre del documento"><br>';

            $("#campos-dos").append(field);
        })
    })
</script>