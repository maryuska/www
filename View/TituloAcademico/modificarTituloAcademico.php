<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';


?>


<div class="col-md-10 izquierda">
    <h3 class="text-center">Modificar Titulo</h3>

    <div class="panel panel-default">
        <div class="col-md-12">
            <form  action="../../Controller/UsuariosController.php" method="post" role="form">
            <?php $rows = $_SESSION["ConsultarTitulo"];
            foreach ($rows as $row) { ?>

                    <div class="form-group">
                        <input id="LoginU" name="LoginU" type="hidden" class="form-control" value="<?php echo $row['LoginU']; ?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="NombreTitulo">Nombre Titulo:</label>
                        <input id="NombreTitulo" name="NombreTitulo" class="form-control" value="<?php echo $row['NombreTitulo']; ?>" disabled>
                        <input id="NombreTitulo" name="NombreTitulo"  type="hidden" class="form-control" value="<?php echo $row['NombreTitulo']; ?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="FechaTitulo">Fecha:</label>
                        <input id="FechaTitulo" type="date" name="FechaTitulo" class="form-control" value="<?php echo $row['FechaTitulo']; ?>"  >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="CentroTitulo">Centro:</label>
                        <input id="CentroTitulo" name="CentroTitulo" class="form-control" value="<?php echo $row['CentroTitulo']; ?>"  >
                    </div>


                    <br>

                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                        <label class="control-label" for="Modificar"></label>
                        <button type="submit" class="btn btn-orange" name="evento" value="modificarTituloAcademico"> Guardar cambios</button>
                    </div>

                </form>
            <?php } ?>
        </div>
    </div>

</div>



