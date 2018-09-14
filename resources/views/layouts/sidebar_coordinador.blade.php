<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('coordinator_index')}}">
                <i class="nav-icon fas fa-home"></i> INICIO
            </a>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-users"></i> Usuarios</a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link ajax-request" href="{{route('candidate_user.index')}}">
                        <i class="nav-icon far fa-user"></i> Aspirantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ajax-request" href="{{route('teacher_user.index')}}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i> Catedraticos</a>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-tasks"></i> Gestión de subida <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;documentos</a>
            <ul class="nav-dropdown-items">

                <li class="nav-item">
                    <a class="nav-link ajax-request" href="{{route('documents.index')}}">
                        <i class="nav-icon far fa-folder"></i> Asignar Documentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ajax-request" href="{{route('document_date.index')}}">
                        <i class="nav-icon far fa-clock"></i> Asignar fecha</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('priest.index')}}">
                <i class="fas fa-book-open"></i> Manual</a>
        </li>
    </ul>
</nav>