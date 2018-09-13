$(document).ready(function () {
    $("#table").DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay datos para mostrar",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(Filtrado de _MAX_ total de registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Buscando...",
            "processing": "Procesando...",
            "search": "Buscar",
            "zeroRecords": "No existen coincidencias con el registro que busca",
            "paginate": {
                "first": "Primer",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }

    });
});