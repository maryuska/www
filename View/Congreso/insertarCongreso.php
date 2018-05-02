<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>

<div class="col-md-10 izquierda">
    <h3 class="text-center">Insertar Congreso</h3>
    <div class="panel panel-default">
        <div class="col-md-12">
            <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="../../Controller/ArticulosController.php" method="post" role="form">

                <div class="form-group">
                    <label class="control-label" for="CodigoA">Código Artículo: </label>
                    <input id="CodigoA" name="CodigoA" type="CodigoA" placeholder="Código Artículo" class="form-control ">
                </div>

                <div class="form-group">
                    <label class="control-label" for="TituloA">Título Artículo:</label>
                    <input id="TituloA" name="TituloA" type="TituloA" placeholder="Título Artículo " class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TituloR">Título Revista:</label>
                    <input id="TituloR" name="TituloR" type="TituloR" placeholder="Título Revista" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="ISSN">ISSN:</label>
                    <input id="ISSN" name="ISSN" type="ISSN" placeholder="ISSN" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="VolumenR">Volumen:</label>
                    <input id="VolumenR" name="VolumenR" type="VolumenR" placeholder="Volumen" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="PagIniA">Página Inicio:</label>
                    <input id="PagIniA" name="PagIniA" type="PagIniA" placeholder="Página Inicio" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="PagFinA">Página Fin:</label>
                    <input id="PagFinA" name="PagFinA" type="PagFinA" placeholder="Página Fin " class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaPublicacionR">Fecha Publicación:</label>
                    <input id="FechaPublicacionR" name="FechaPublicacionR" type="date" placeholder="Fecha Publicación" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="EstadoA">Estado Artículo:</label>
                    <p> <select type="EstadoA"  class="form-control"  id="EstadoA" name="EstadoA">
                            <option>--</option>
                            <option>Enviado</option>
                            <option>Revisión</option>
                            <option>Publicado</option>
                        </select></p>
                </div>
                <br>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Registrar"></label>
                    <button type="submit" id="Registrar" name="evento" value="altaArticulo" class="btn btn-orange"> Insertar </button>
                </div>

            </form>
        </div>
    </div>

</div>



