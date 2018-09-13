<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('master_index')}}">
                <i class="nav-icon fas fa-home"></i> INICIO
            </a>
        </li>
        <li class="nav-title">ADMINISTRACIÓN</li>
        <li class="nav-item">
            <a class="nav-link ajax-request" href="{{route('master_user.index')}}">
                <i class="nav-icon fas fa-user-tie"></i> Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link ajax-request" href="{{route('campus.index')}}">
                <i class="nav-icon fas fa-university"></i> Campus</a>
        </li>
        <li class="nav-item">
            <a class="nav-link ajax-request" href="{{route('faculty.index')}}">
                <i class="nav-icon fas fa-graduation-cap"></i> Facultades</a>
        </li>
        <li class="nav-item">
            <a class="nav-link ajax-request" href="{{route('parish.index')}}">
                <i class="nav-icon fas fa-church"></i> Parroquias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link ajax-request" href="{{route('priest.index')}}">
                <i class="nav-icon fas fa-male"></i> Parrocos</a>
        </li>
    </ul>
</nav>