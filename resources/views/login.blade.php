<!DOCTYPE html>
<html lang="es">

@include('layouts.head')

<body>
<div class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form action="{{route('login')}}" method="post">
                    {{csrf_field()}}
                    <div class="card-group">
                        <div class="card p-3">
                            @if(session()->has('flash'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('flash')  }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="align-items-center">
                                    <img src="{{asset('imagenes/logo.png')}}" width="230" height="80" alt="Logo de Regivit">
                                </div>
                                <br>
                                <h2>Inicio de Sesión</h2>
                                <div class="form-group {{ $errors->has('identity') ? 'has-error' : ''}}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input type="text" name="identity" class="form-control" placeholder="Identidad">
                                    {!! $errors->first('identidad', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                    {!! $errors->first('contrasenia', '<span class="help-block">:message</span>')!!}
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4">Acceder</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="footer-fixed">
    @include('layouts.footer')
</footer>
</body>
</html>