<?php
require_once 'View/Structure/Header.php';
require_once 'View/Structure/Nav.php';

?>


<div class="col-md-10 izquierda">
    <h3 class="text-center">Modificar Perfil</h3>

    <div class="panel panel-default">
        <div class="col-md-12">
            <?php $rows = $_SESSION["ConsultarU"];

            foreach ($rows as $row) { ?>

                <form  action="index.php?controlador=Usuarios" method="post" role="form">

                    <div class="form-group">
                        <label class="control-label" for="LoginU">Login: </label>
                        <input id="LoginU" name="LoginU"  class="form-control "value="<?php echo $row['LoginU']; ?>" disabled >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="NombreU">Nombre:</label>
                        <input id="NombreU" name="NombreU" class="form-control" value="<?php echo $row['NombreU']; ?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="ApellidosU">Apellidos:</label>
                        <input id="ApellidosU" name="ApellidosU" class="form-control" value="<?php echo $row['ApellidosU']; ?>"  >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Telefono">Telefono:</label>
                        <input id="Telefono" name="Telefono" class="form-control" value="<?php echo $row['Telefono']; ?>"  >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Mail">Mail:</label>
                        <input id="Mail" name="Mail" class="form-control" value="<?php echo $row['Mail']; ?>"  >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="DNI">DNI:</label>
                        <input id="DNI" name="DNI" class="form-control" value="<?php echo $row['DNI']; ?>"  >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="FechaNacimiento">Fecha Nacimiento:</label>
                        <input id="FechaNacimiento" type="date" name="FechaNacimiento" class="form-control " value="<?php echo $row['FechaNacimiento']; ?>"  >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="TipoContrato">Tipo Contrato:</label>
                        <input id="TipoContrato" name="TipoContrato" class="form-control " value="<?php echo $row['TipoContrato']; ?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Centro">Centro:</label>
                        <input id="Centro" name="Centro" class="form-control "value="<?php echo $row['Centro']; ?>"  >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Departamento">Departamento:</label>
                        <input id="Departamento" name="Departamento" class="form-control "value="<?php echo $row['Departamento']; ?>"  >
                    </div>

                    <br>

                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                        <label class="control-label" for="Modificar"></label>
                        <button type="submit" class="btn btn-orange" name="evento" value="modificarUsuario"> Guardar cambios</button>
                    </div>

                </form>
            <?php } ?>
        </div>
    </div>

</div>



