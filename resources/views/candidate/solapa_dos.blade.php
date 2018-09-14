
<!DOCTYPE html>
<html lang="es">

@include('layouts.head')

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<script src="{{asset('js/dropzone.js')}}"></script>

@include('layouts.header')

<div class="app-body">
    <div class="sidebar">
        @include('layouts.sidebar_aspirante')
    </div>
    <div class="main">
        <div class="container-fluid">
            <div id="contenido">
                <br><br>
                <div class="animated fadeIn card">
                    <div class="card-header">
                        <i class="far fa-folder-open"></i> Solapa N° 2
                    </div>
                    <div class="card-body">

                        <div class="list-group hover">
                            @foreach($document_list as $list)
                                @if($list['visibility'] != 2)
                                    <li data-toggle="modal"
                                        data-target="#modal_formulario"
                                        class="list-group-item list-group-item-action click"
                                        data-flag="{{$list['id']}}">{{$list['name']}}
                                        @if ($list['status'] === 'Upload')
                                            <div class="col-sm-2 justify-content-center float-right">
                                                <a class="item fas fa-check-circle font-sm text-success col-sm-1 float-right"></a>
                                            </div>
                                        @else
                                            <div class="col-sm-2 justify-content-center float-right">
                                                <a class="item fas fa-upload font-sm text-info col-sm-1 float-right"></a>
                                            </div>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Contenido del modal -->
        <div class="modal-content">
            <!--Cabecera para el modal -->
            <div class="modal-header card-header">
                <!--Titulo para el modal -->
                <h5 class="modal-title">Subir Archivo</h5>
                <!--Boton para cerrar el modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Cuerpo para el modal -->
            <div class="modal-body">
                <form action="{{route('tab_one.store')}}" class="dropzone" method="post"
                      id="my-awesome-dropzone" enctype="multipart/form-data" accept="image/gif,image/jpeg">
                    {{csrf_field()}}
                    <input type="hidden" name="document_type" class="document_type" value="">
                </form>
                <br>
                <div class="link" id="document_link" style="display: none">
                    Nombre archivo subido: <a href="" id="path"> <i class="far fa-file-pdf"></i></a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelar">Cancelar</button>
                <button type="button" class="btn btn-success" id="crear">Guardar</button>
            </div>
        </div>
    </div>
</div>


@include('layouts.footer')

@include('layouts.scripts')

<script>
    $(document).ready(function () {
        $(".click").click(function (e) {
            e.preventDefault();
            var getData = $(this).data('flag');
            $(".document_type").attr("value", getData);

            var path = 'tab_two/' + getData + '/edit';

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: path,
                data: {'document_id': getData},
                success: function (data) {
                    if (data['status'] === false) {
                        hidenLink();
                    } else {
                        showLink(data);
                        $("#path").html(data['status'][0]['path'] + ' <i class="far fa-file-pdf"></i>');
                        $("#path").attr('href', 'preview_tab/' + data['status'][0]['path']);
                    }
                }

            });
        });

        function hidenLink() {
            $("#document_link").css('display', 'none');
        }

        function showLink(data) {
            $("#document_link").css('display', 'block');
        }

    })
</script>

<script>
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file",
        addRemoveLinks: true,
        acceptedFiles: "application/pdf, image/*",
        maxFiles: 1,
        dictDefaultMessage: "De click o arrastre el archivo para subirlo",
        dictInvalidFileType: "Solo se permiten archivos con extension pdf o imagenes",
        dictRemoveFile: "Remover archivo",

        init: function () {
            myAwesomeDropzone = this;

            $("#crear").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                myAwesomeDropzone.processQueue();
                myAwesomeDropzone.removeAllFiles(true);
            });

            this.on("complete", function (file) {
                $("#modal_formulario").modal('hide');
            })
        }
    };
</script>

<script>
    var end = new Date('{{$end_date}}');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown').innerHTML = days + ' dias, ';
        document.getElementById('countdown').innerHTML += hours + ' horas, ';
        document.getElementById('countdown').innerHTML += minutes + ' minutos y ';
        document.getElementById('countdown').innerHTML += seconds + ' segundos';
    }

    timer = setInterval(showRemaining, 1000);
</script>

</body>
</html>
