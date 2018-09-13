<br><br>
<div class="card animated fadeIn">
    <div class="card-header">
        <i class="far fa-folder"></i> Asignar Documentos
    </div>
    <div class="card-body">
        <p>
            <a class="btn btn-primary one" data-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" aria-controls="collapseExample">
                Solapa Uno
            </a>
            <button class="btn btn-primary two" type="button" data-toggle="collapse"
                    data-target="#collapseExample1"
                    aria-expanded="true" aria-controls="collapseExample">
                Solapa Dos
            </button>
        </p>
        <div class="collapse general" id="collapseExample">
            <div class="card card-body">

                <form action="#" method="POST" id="form_tab_one">
                    <input type="hidden" value="{{csrf_token()}}" id="token_uno">
                    <input type="hidden" name="number_tab" value="1">
                    <div class="form-group">
                        <input type="text" name="tab[]" class="form-control"
                               placeholder="Ingrese el nombre del documento" required>
                    </div>
                    <div id="campos"></div>
                    <br>
                    <div class="float-right">
                        <button class="btn btn-primary" id="add">Agregar</button>
                        <button class="btn btn-success" id="save">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="collapse general" id="collapseExample1">
            <div class="card card-body">

                <form action="#" method="POST" id="form_tab_two">
                    <input type="hidden" value="{{csrf_token()}}" id="token_dos">
                    <input type="hidden" name="number_tab" value="2" required>
                    <div class="form-group">
                        <input type="text" name="tab[]" class="form-control"
                               placeholder="Ingrese el nombre del documento">
                    </div>
                    <div id="campos-dos"></div>
                    <br>
                    <div class="float-right">
                        <button class="btn btn-primary" id="add-dos">Agregar</button>
                        <button class="btn btn-success" id="guardar-dos">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>