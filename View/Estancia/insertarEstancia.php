<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>

<div class="col-md-10 izquierda">
    <h3 class="text-center">Insertar Proyecto Dirigido</h3>
        <div class="panel panel-default">
            <div class="col-md-12">
            <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="../../Controller/ProyectosDirigidosController.php" method="post" role="form">

                <div class="form-group">
                    <label class="control-label" for="CodigoPD">Código Proyecto Dirigido: </label>
                    <input id="CodigoPD" name="CodigoPD" type="CodigoPD" placeholder="Código Proyecto Dirigido" class="form-control ">
                </div>

                <div class="form-group">
                    <label class="control-label" for="TituloPD">Título Proyecto Dirigido:</label>
                        <input id="TituloPD" name="TituloPD" type="TituloPD" placeholder="Título Proyecto Dirigido" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="AlumnoPD">Alumno:</label>
                    <input id="AlumnoPD" name="AlumnoPD" type="AlumnoPD" placeholder="Alumno" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaLecturaPD">Fecha lectura:</label>
                    <input id="FechaLecturaPD" name="FechaLecturaPD" type="date" placeholder="Fecha lectura" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CalificacionPD">Calificación:</label>
                    <p> <select type="CalificacionPD"  class="form-control"  id="CalificacionPD" name="CalificacionPD">
                            <option>--</option>
                            <option>Aprobado</option>
                            <option>Notable</option>
                            <option>Sobresaliente</option>
                            <option>Matricula</option>
                        </select></p>
                </div>

                <div class="form-group">
                    <label class="control-label" for="URLPD">URL:</label>
                    <input id="URLPD" name="URLPD" type="URLPD" placeholder="URL" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CotutorPD">Cotutor:</label>
                    <input id="CotutorPD" name="CotutorPD" type="CotutorPD" placeholder="Cotutor" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoPD">Tipo:</label>
                    <p> <select type="TipoPD"  class="form-control"  id="TipoPD" name="TipoPD">
                            <option>--</option>
                            <option value="PFC" >Proyecto Fin de Carrera</option>
                            <option value="TFG">Trabajo Fin de Grado</option>
                            <option value="TFM">Trabajo Fin de Master</option>
                        </select></p>
                </div>
                <br>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Registrar"></label>
                        <button type="submit" id="Registrar" name="evento" value="altaProyectoDirigido" class="btn btn-orange"> Insertar </button>
                </div>

            </form>
            </div>
        </div>

    </div>



