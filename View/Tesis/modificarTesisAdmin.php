
<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';
?>



<div class="container-fluid">
    <div class="row">

        <?php
        // Menu lateral
        require_once 'View/Structure/Sidebar.php';
        ?>

        <!-- Contenido -->
        <div class="col-md-offset-1 col-md-8 col-lg-offset-3 col-lg-4">
            <div class="cotainer">

                <?php
                // Usuario en session
                $rows = $_SESSION["consultarTesis"];

                // Si existe errores mostramos mensaje de error
                if(isset($errores) && !empty($errores)){
                    echo "<br>";
                    echo "<br>";
                    echo "<div class='row'>";
                    echo "  <div class='col-md-offset-4 col-md-8 col-lg-offset-3 col-lg-9'>";
                    require_once "View/errores.php";
                    echo "  </div>";
                    echo "</div>";
                }

                foreach ($rows as $row) {
                    ?>

                    <!-- Formulario -->

                    <form id="formularioModificarTesis" action="index.php?controlador=Tesis" method="post">

                        <!--  -->

                        <h2 class="text-center">Modificar Tesis</h2>

                        <br>
                        <div class="form-group">
                            <label class="control-label" for="LoginU">Login usuario</label>
                            <select id="LoginU" name="LoginU" type="text" placeholder="Login usuario" class="form-control <?php if(isset($errores) && in_array("LoginU", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["LoginU"])?$_POST["LoginU"]:''?>">
                                <option value="">--</option>
                                <?php
                                $rowsU = $_SESSION["listarUsuarios"];
                                foreach ($rowsU as $rowU){
                                    if(isset($_POST["LoginU"])){
                                        ?>
                                        <option value="<?php echo $rowU['LoginU'];?>" <?php if(isset($_POST["LoginU"]) && $_POST["LoginU"] == $rowU['LoginU']){ echo "selected"; } ?>><?php echo $rowU['LoginU']." - ".$rowU['NombreU'];?></option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option value="<?php echo $rowU['LoginU'];?>" <?php if($row["LoginU"] == $rowU['LoginU']){ echo "selected"; } ?>><?php echo $rowU['LoginU']." - ".$rowU['NombreU'];?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CodigoTesis">Codigo Tesis: </label>
                            <input id="CodigoTesis2" name="CodigoTesis2"  class="form-control " value="<?php echo $row['CodigoTesis']; ?>" disabled >
                            <input id="CodigoTesis" name="CodigoTesis" class="hidden" value="<?php echo $row['CodigoTesis']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AutorTesis">Autor:</label>
                            <input id="AutorTesis" name="AutorTesis" class="form-control" <?php if(isset($errores) && in_array("AutorTesis", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AutorTesis"])?$_POST["AutorTesis"]:$row['AutorTesis']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaInscripcion">Fecha inscripción:</label>
                            <input id="FechaInscripcion" type="date" name="FechaInscripcion" class="form-control "<?php if(isset($errores) && in_array("FechaInscripcion", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaInscripcion"])?$_POST["FechaInscripcion"]:$row['FechaInscripcion']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaLectura">Fecha lectura:</label>
                            <input id="FechaLectura" type="date" name="FechaLectura" class="form-control "<?php if(isset($errores) && in_array("FechaLectura", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaLectura"])?$_POST["FechaLectura"]:$row['FechaLectura']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CalificacionTesis">Cuatrimestre:</label>
                            <p> <select class="form-control" id="CalificacionTesis" name="CalificacionTesis">
                                    <option value="">--</option>
                                    <?php
                                    if(isset($errores)){
                                        ?>
                                        <option <?php if(isset($_POST["CalificacionTesis"]) && $_POST["CalificacionTesis"] == "Aprobado"){ echo "selected"; } ?>>Aprobado</option>
                                        <option <?php if(isset($_POST["CalificacionTesis"]) && $_POST["CalificacionTesis"] == "Notable"){ echo "selected"; } ?>>Notable</option>
                                        <option <?php if(isset($_POST["CalificacionTesis"]) && $_POST["CalificacionTesis"] == "Sobresaliente"){ echo "selected"; } ?>>Sobresaliente</option>
                                        <option <?php if(isset($_POST["CalificacionTesis"]) && $_POST["CalificacionTesis"] == "Matricula"){ echo "selected"; } ?>>Matricula</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option <?php if($row["CalificacionTesis"] == "Aprobado"){ echo "selected"; } ?>>Aprobado</option>
                                        <option <?php if($row["CalificacionTesis"] == "Notable"){ echo "selected"; } ?>>Notable</option>
                                        <option <?php if($row["CalificacionTesis"] == "Sobresaliente"){ echo "selected"; } ?>>Sobresaliente</option>
                                        <option <?php if($row["CalificacionTesis"] == "Matricula"){ echo "selected"; } ?>>Matricula</option>
                                        <?php
                                    }
                                    ?>

                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="URLTesis">URL:</label>
                            <input id="URLTesis" name="URLTesis" class="form-control" <?php if(isset($errores) && in_array("URLTesis", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["URLTesis"])?$_POST["URLTesis"]:$row['URLTesis']?>" >
                        </div>
                        <br>

                        <div class="text-center">
                            <input type="hidden" name="evento" value="modificarTesis">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarTesis();">
                                Guardar cambios
                            </button>
                        </div>

                    </form>

                    <br>
                    <br>

                    <?php
                }
                ?>

            </div>
        </div>

    </div>
</div>
<!-- Confirmar modificar tesis -->
<div id="confirmModificarTesis" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos de la tesis?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar tesis -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarTesis"]);
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

