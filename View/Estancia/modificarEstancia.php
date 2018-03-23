<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>


<div class="col-md-10 izquierda">
    <h3 class="text-center">Modificar Proyecto Dirigido</h3>

    <div class="panel panel-default">
        <div class="col-md-12">
            <?php foreach ($_SESSION["consultarProyectoDirigido"] as $row)  { ?>
            <form  action="../../Controller/ProyectosDirigidosController.php" method="post" role="form">

                <div class="form-group">
                    <label class="control-label" for="CodigoPD">Código Proyecto Dirigido: </label>
                    <input id="CodigoPD" name="CodigoPD"  class="form-control "value="<?php echo $row['CodigoPD']; ?>" disabled >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TituloPD">Título Proyecto Dirigido:</label>
                    <input id="TituloPD" name="TituloPD" class="form-control" value="<?php echo $row['TituloPD']; ?>" >
                </div>

                <div class="form-group">
                    <label class="control-label" for="AlumnoPD">Alumno:</label>
                    <input id="AlumnoPD" name="AlumnoPD" class="form-control" value="<?php echo $row['AlumnoPD']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaLecturaPD">Fecha lectura:</label>
                    <input id="FechaLecturaPD" type="date" name="FechaLecturaPD" class="form-control " value="<?php echo $row['FechaLecturaPD']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CalificacionPD">Calificación:</label>
                    <p> <select class="form-control"  id="CalificacionPD" name="CalificacionPD">
                            <option> <?php echo $row['CalificacionPD']; ?> </option>
                            <option>-----------------------</option>
                            <option>Aprobado</option>
                            <option>Notable</option>
                            <option>Sobresaliente</option>
                            <option>Matricula</option>
                        </select></p>
                </div>

                <div class="form-group">
                    <label class="control-label" for="URLPD">URL:</label>
                    <input id="URLPD" name="URLPD" class="form-control " value="<?php echo $row['URLPD']; ?>" >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CotutorPD">Cotutor:</label>
                    <input id="CotutorPD" name="CotutorPD" class="form-control "value="<?php echo $row['CotutorPD']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoPD">Tipo:</label>
                    <p> <select  class="form-control"  id="TipoPD" name="TipoPD"  >
                            <option> <?php echo $row['TipoPD']; ?> </option>
                            <option>-----------------------</option>
                            <option value="PFC" >Proyecto Fin de Carrera</option>
                            <option value="TFG">Trabajo Fin de Grado</option>
                            <option value="TFM">Trabajo Fin de Master</option>
                        </select></p>
                </div>
                <br>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Modificar"></label>
                    <button type="submit" class="btn btn-orange" name="evento" value="modificarProyectosDirigidos"> Guardar cambios</button>
                </div>

            </form>
            <?php } ?>
        </div>
    </div>

</div>



