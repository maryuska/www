<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>


<div class="col-md-10 izquierda">
    <h3 class="text-center">Modificar Estancia</h3>

    <div class="panel panel-default">
        <div class="col-md-12">
            <?php foreach ($_SESSION["consultarEstancia"] as $row)  { ?>
            <form  action="../../Controller/EstanciasController.php" method="post" role="form">

                <input id="LoginU" name="LoginU" type="hidden" class="form-control "value="<?php echo $row['LoginU']; ?>"  >

                <div class="form-group">
                    <label class="control-label" for="CodigoE">Código Estancia: </label>
                    <input id="CodigoE" name="CodigoE"  class="form-control "value="<?php echo $row['CodigoE']; ?>" disabled >
                    <input id="CodigoE" name="CodigoE" type="hidden" class="form-control "value="<?php echo $row['CodigoE']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CentroE">Centro:</label>
                    <input id="CentroE" name="CentroE" class="form-control" value="<?php echo $row['CentroE']; ?>" >
                </div>

                <div class="form-group">
                    <label class="control-label" for="UniversidadE">Universidad:</label>
                    <input id="UniversidadE" name="UniversidadE" class="form-control" value="<?php echo $row['UniversidadE']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="PaisE">País:</label>
                    <input id="PaisE" name="PaisE" class="form-control" value="<?php echo $row['PaisE']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaInicioE">Fecha Inicio:</label>
                    <input id="FechaInicioE" type="date" name="FechaInicioE" class="form-control " value="<?php echo $row['FechaInicioE']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaFinE">Fecha Fin:</label>
                    <input id="FechaFinE" type="date" name="FechaFinE" class="form-control " value="<?php echo $row['FechaFinE']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoE">Tipo:</label>
                    <p> <select class="form-control"  id="TipoE" name="TipoE">
                            <option> <?php echo $row['TipoE']; ?> </option>
                            <option>-----------------------</option>
                            <option>Investigación</option>
                            <option>Doctorado</option>
                            <option>Invitación</option>
                        </select></p>
                </div>

                <br>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Modificar"></label>
                    <button type="submit" class="btn btn-orange" name="evento" value="modificarEstancia"> Guardar cambios</button>
                </div>

            </form>
            <?php } ?>
        </div>
    </div>

</div>



