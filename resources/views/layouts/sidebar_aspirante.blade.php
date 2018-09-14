<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('candidate_index')}}">
                <i class="nav-icon fas fa-home"></i> INICIO
            </a>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon far fa-edit"></i> Formularios</a>
            <ul class="nav-dropdown-items">

                    <li class="nav-item">
                        <a class="nav-link ajax-request" href="{{route('job_form.index')}}">
                            <i class="nav-icon far fa-file-alt"></i> Solicitud de empleo</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link ajax-request" href="{{route('personal_data_form.index')}}">
                            <i class="nav-icon far fa-file-alt"></i> Datos personales</a>
                    </li>

            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-archive"></i> Documentos</a>
            <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tab_one.index')}}">
                            <i class="nav-icon far fa-folder-open"></i> Solapa N° 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ajax-request" href="{{route('tab_two.index')}}">
                            <i class="nav-icon far fa-folder-open"></i> Solapa N° 2</a>
                    </li>
            </ul>
        </li>

    </ul>
</nav>