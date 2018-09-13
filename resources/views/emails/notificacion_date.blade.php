<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

<div class="app-body">

    <div class="main">
        <p>Fecha de inicio: {{$start_date}}</p>
        <p>Fecha limite: {{$end_date}}</p>
    </div>

</div>

@include('layouts.footer')

</body>
</html>

