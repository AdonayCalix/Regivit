<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand">
        <img class="navbar-brand-full" src="{{asset('imagenes/logo.png')}}" width="125" height="40" alt="Regivit">
        <img class="navbar-brand-minimized" src="{{asset('imagenes/logo.png')}}" width="30" height="30" alt="Regivit">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
        @if (auth()->user()->user_type == 3 || auth()->user()->user_type == 4)
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="far fa-clock"></i>
                    <span class="badge badge-pill badge-info text-white">1</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Tiempo disponible</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <div id="countdown"></div>
                    </a>
                </div>
            </li>
        @endif

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <i class="far fa-user-circle"></i>
                {{--<img class="img-avatar" src="">--}}
                {{auth()->user()->first_name . " " . auth()->user()->first_surname}} &nbsp;&nbsp;
            </a>
            <div class="dropdown-menu dropdown-menu-right">
               {{-- <div class="dropdown-header text-center">
                    <strong>Cuenta</strong>
                </div>--}}
                {{--<a class="dropdown-item" href="#" id="show_info">
                    <i class="fas fa-cog"></i> Información de perfil
                    <Perfil></Perfil>
                </a>--}}
                <div class="dropdown-header text-center">
                    <strong>Configurciones</strong>
                </div>
                <form action="{{route('logout')}}" method="post">
                    {{csrf_field()}}
                    <button class="dropdown-item">
                        <i class="fa fa-user"></i> Cerrar Sesion
                    </button>
                </form>
            </div>
        </li> &nbsp;&nbsp;
    </ul>
</header>