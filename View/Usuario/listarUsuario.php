<?php

require_once '../View/Structure/Header.php';
require_once '../View/Structure/Nav.php';

$usuario = $_SESSION["listarUsuarios"];

?>


<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

        <?php foreach ($usuario as $row) { ?>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
            <form role="form " action="../../Controller/UsuariosController.php" method="post">

                    <li type="disc">
                    <label for="NombreU">Nombre</label></li>
                    <input type="NombreU" class="form-control" id="NombreU" value="<?php echo $row['NombreU']?>" disabled>
                    <input type="hidden" name="NombreU" class="form-control" id="NombreU" value="<?php echo $row['NombreU']?>">
                    <label for="ApellidosU">Apellidos</label></li>
                    <input type="ApellidosU" class="form-control" id="ApellidosU" value="<?php echo $row['ApellidosU']?>" disabled>
                    <input type="hidden" name="ApellidosU" class="form-control" id="ApellidosU" value="<?php echo $row['ApellidosU']?>">
                    <label for="UniversidadU">Universidad</label></li>
                    <input type="UniversidadU" class="form-control" id="UniversidadU" value="<?php echo $row['UniversidadU']?>" disabled>
                    <input type="hidden" name="UniversidadU" class="form-control" id="UniversidadU" value="<?php echo $row['UniversidadU']?>">

                    <BR>
                    <button name="evento" value="consultarUsuario" type="submit" class="btn btn-default">Consultar Usuario</button>
            </form>
          </div>
        <?php }?>


</div>




<?php

require_once 'Structure/Footer.php';

?>
