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
                <img src="{{asset('imagenes/fondo.png')}}" style="width: 50%; height: 25%; display: block; margin: auto; margin-top: 50px">
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@include('layouts.scripts')

</body>
</html>