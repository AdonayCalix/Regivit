<!-- Modal -->
<div class="modal fade" id="report_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-chart-bar"></i> Reporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#information"
                           role="tab"
                           aria-controls="home" aria-selected="true">Información del catedratico</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_1" role="tab"
                           aria-controls="profile" aria-selected="false">Documentos Solapa 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_2" role="tab"
                           aria-controls="contact" aria-selected="false">Documentos solapa 2</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="information" role="tabpanel"
                         aria-labelledby="home-tab">
                        <div class="row">

                          {{--  <div class="col-md-5">
                                <img src="https://i.ytimg.com/vi/GQsryfQcopw/hqdefault.jpg" class="img-thumbnail">
                            </div>--}}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                       <strong>Nombre: </strong>
                                    </div>
                                    <div class="col-md-6">
                                       <p class="font-weight-light" id="name"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Fecha de nacimiento: </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="font-weight-light" id="nacimiento"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Fecha de ingreso: </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="font-weight-light" id="ingreso"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Vehiculo: </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="font-weight-light" id="vehiculo"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Pregado: </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="font-weight-light" id="pregado"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Postgradro: </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="font-weight-light" id="posgrado"></p>
                                    </div>
                                </div>
                                <br>

                                    Solapa 1 &nbsp; <p id="info_one"></p>
                                    <div class="progress">
                                        <div id="solapauno" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <br>
                                Solapa 2 &nbsp; <p id="info_two"></p>
                                <div class="progress">
                                    <div id="solapados" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_1" role="tabpanel" aria-labelledby="profile-tab">
                        <ul class="list-group list-group-flush hover" id="list_one">

                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="contact-tab">
                        <ul class="list-group list-group-flush" id="list_two">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
