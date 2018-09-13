<!DOCTYPE html>
<html lang="es">

@include('layouts.head')

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

@include('layouts.header')

<div class="app-body">
    <div class="sidebar">
        @include('layouts.sidebar_aspirante')
    </div>
    <div class="main">
        <div class="container-fluid">
            <div id="contenido">
                <br>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Tiempo agotado para subir archivos</strong>. <br>
                    <strong>Comunicate con tu coordinador academico para renovar el tiempo</strong>
                </div>
                {{\App\Http\Controllers\TabDisabledController::validateTime()}}
                <div class="animated fadeIn card">
                    <div class="card-header">
                        <i class="far fa-folder-open"></i> Solapa N° 1
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
@include('layouts.footer')
@include('layouts.scripts')
</body>
</html>
