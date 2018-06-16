<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>


<div class="col-md-10 izquierda">
    <h3 class="text-center">Proyecto Dirigido</h3>

    <div class="panel panel-default">
        <div class="col-md-12">
            <?php foreach ($_SESSION["consultarProyectoDirigido"] as $row)  { ?>
                <form  action="../../Controller/ProyectosDirigidosController.php" method="post" role="form">

                    <div class="form-group">
                        <label class="control-label" for="CodigoPD">Código Proyecto Dirigido: </label>
                        <input id="CodigoPD" name="CodigoPD"  class="form-control "value="<?php echo $row['CodigoPD']; ?>" disabled >

                    </div>
                    <div class="form-group">
                        <label class="control-label" for="LoginU">Login Usuario:</label>
                        <input id="LoginU" name="LoginU" class="form-control" value="<?php echo $row['LoginU']; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="TituloPD">Título Proyecto Dirigido:</label>
                        <input id="TituloPD" name="TituloPD" class="form-control" value="<?php echo $row['TituloPD']; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="AlumnoPD">Alumno:</label>
                        <input id="AlumnoPD" name="AlumnoPD" class="form-control" value="<?php echo $row['AlumnoPD']; ?>" disabled >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="FechaLecturaPD">Fecha lectura:</label>
                        <input id="FechaLecturaPD" type="date" name="FechaLecturaPD" class="form-control " value="<?php echo $row['FechaLecturaPD']; ?>"  disabled>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="CalificacionPD">Calificacion:</label>
                        <input id="CalificacionPD" type="date" name="CalificacionPD" class="form-control " value="<?php echo $row['CalificacionPD']; ?>"  disabled>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="URLPD">URL:</label>
                        <input id="URLPD" name="URLPD" class="form-control " value="<?php echo $row['URLPD']; ?>" disabled >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="CotutorPD">Cotutor:</label>
                        <input id="CotutorPD" name="CotutorPD" class="form-control "value="<?php echo $row['CotutorPD']; ?>" disabled >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="TipoPD">Tipo:</label>
                        <input id="TipoPD" name="TipoPD" class="form-control "value="<?php echo $row['TipoPD']; ?>" disabled >
                    </div>


                    <br>
                    <p align="center ">
                        <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=borrarProyectoDirigido&CodigoPD=<?php echo $row['CodigoPD']; ?>&LoginU=<?php echo $row['LoginU']; ?>'">Borrar definitivamente</button>
                        <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=consultarDetalleProyectoDirigido&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Cancelar borrado</button>
                    </p>


                </form>
            <?php } ?>
        </div>
    </div>

</div>



