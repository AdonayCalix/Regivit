<script>
    $(document).ready(function () {
        $("#add").click(function (e) {
            e.preventDefault();
            var campo = '<input type="text" name="tab[]" class="form-control"\n' +
                'placeholder="Ingrese el nombre del documento"><br>';

            $("#campos").append(campo);
        })
    })
</script>


<script>
    $(document).ready(function () {
        $("#add-dos").click(function (e) {
            e.preventDefault();
            var campo = '<input type="text" name="tab[]" class="form-control"\n' +
                'placeholder="Ingrese el nombre del documento"><br>';

            $("#campos-dos").append(campo);
        })
    })
</script>
