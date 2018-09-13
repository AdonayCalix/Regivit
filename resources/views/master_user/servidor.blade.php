<!DOCTYPE html>
<html lang="es">

@include('layouts.head')

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

@include('layouts.header')

<div class="app-body">
    <div class="sidebar">
        @include('layouts.sidebar_maestro')
    </div>
    <div class="main">
        <div class="container-fluid">
            <div id="contenido">
                <br><br>
                <div class="card animated fadeIn">
                    <div class="card-header">
                        <i class="fas fa-server"></i>Configuración del servidor
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="">IP</label>
                                <input type="text" class="form-control" name="ihss"
                                       placeholder="Ingrese la direccion ip del servidor">
                            </div>
                            <div class="form-group col">
                                <label for="">Puerto</label>
                                <input type="text" class="form-control" name="rap_fosovi"
                                       placeholder="Ingrese el puerto del servidor">
                            </div>
                        </div>
                        <div >
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary">Cancelar</button>
                                <button type="button" class="btn btn-success">Guardar</button>
                            </div>

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