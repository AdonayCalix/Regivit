$(document).ready(function () {
    function valida(e) {
        tecla = (document.all) ? e.keycode : e.which;
        //tecla de retroceso para borrar, siempre la permite
        if (tecla == 8 || tecla == 0) {
            return true;
        }
        // patron de entrada, en este caso solo acepta numeros
        patron = /[0-9]/;
        tecla_final = string.fromcharcode(tecla);
        return patron.test(tecla_final);
    }

    function letras(e) {
        tecla = (document.all) ? e.keycode : e.which;
        //tecla de retroceso para borrar, siempre la permite
        if (tecla == 8 || tecla == 32 || tecla == 0) {
            return true;
        }
        // patron de entrada, en este caso solo acepta numeros y letras
        patron = /[a-za-z]/;
        tecla_final = string.fromcharcode(tecla);
        return patron.test(tecla_final);
    }

    $(document).ready(function () {
        $('#tipo_usuario').on('change', function () {
            if ($(this).val() == 2) {
                $("#facultad").css('display', 'block');
            } else {
                $("#facultad").css('display', 'none');
            }
        })
    })

})
