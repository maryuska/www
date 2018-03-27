<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>


<div class="col-md-10 izquierda">
    <h3 class="text-center">Modificar Materia</h3>

    <div class="panel panel-default">
        <div class="col-md-12">
            <?php foreach ($_SESSION["consultarMateria"] as $row)  { ?>
            <form  action="../../Controller/MateriasController.php" method="post" role="form">

                <div class="form-group">
                    <label class="control-label" for="CodigoM">Código Materia: </label>
                    <input id="CodigoM" name="CodigoM"  class="form-control "value="<?php echo $row['CodigoM']; ?>" disabled >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoM">Tipo de materia:</label>
                    <p> <select class="form-control"  id="TipoM" name="TipoM">
                            <option> <?php echo $row['TipoM']; ?> </option>
                            <option>------------------------</option>
                            <option>Grado</option>
                            <option>Tercer Ciclo</option>
                            <option>Curso</option>
                            <option>Master</option>
                            <option>Post Grado</option>
                        </select></p>
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoParticipacionM">Tipo de participación:</label>
                    <p> <select class="form-control"  id="TipoParticipacionM" name="TipoParticipacionM">
                            <option> <?php echo $row['TipoParticipacionM']; ?> </option>
                            <option>------------------------</option>
                            <option>Director</option>
                            <option>Docente</option>
                        </select></p>
                </div>

                <div class="form-group">
                    <label class="control-label" for="DenominacionM">Denominación:</label>
                    <input id="DenominacionM" name="DenominacionM" class="form-control" value="<?php echo $row['DenominacionM']; ?>" >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TitulacionM">Titulación:</label>
                    <input id="TitulacionM" name="TitulacionM" class="form-control" value="<?php echo $row['TitulacionM']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="AnhoAcademicoM">Año académico:</label>
                    <input id="AnhoAcademicoM" type="AnhoAcademicoM" name="AnhoAcademicoM" class="form-control " value="<?php echo $row['AnhoAcademicoM']; ?>"  >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CreditosM">Creditos:</label>
                    <input id="CreditosM" name="CreditosM" class="form-control " value="<?php echo $row['CreditosM']; ?>" >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CuatrimestreM">Cuatrimestre:</label>
                    <p> <select class="form-control"  id="CuatrimestreM" name="CuatrimestreM">
                            <option> <?php echo $row['CuatrimestreM']; ?> </option>
                            <option>-----------------------</option>
                            <option>Primero</option>
                            <option>Segundo</option>
                            <option>Anual</option>
                        </select></p>
                </div>

                <br>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Modificar"></label>
                    <button type="submit" class="btn btn-orange" name="evento" value="modificarMateria"> Guardar cambios</button>
                </div>

            </form>
            <?php } ?>
        </div>
    </div>

</div>



