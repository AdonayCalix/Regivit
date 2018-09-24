<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¡Tienes que llenar primero la solicitud de empleo!
            </div>
            <div class="modal-footer">
                <button type="button" id="volver" class="btn btn-primary">Volver al menu principal</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#exampleModal").modal('show');
</script>

<script>
    $("#volver").click(function () {
        location.reload(true);
    })
</script>