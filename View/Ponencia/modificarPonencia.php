
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
                $rows = $_SESSION["consultarPonencia"];

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

                    <form id="formularioModificarPonencia" action="index.php?controlador=Ponencia" method="post">

                        <!-- Docente -->

                        <h2 class="text-center">Modificar Ponencia</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoP">Codigo Ponencia: </label>
                            <input id="CodigoP2" name="CodigoP2"  class="form-control " value="<?php echo $row['CodigoP']; ?>" disabled >
                            <input id="CodigoP" name="CodigoP" class="hidden" value="<?php echo $row['CodigoP']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                            <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TituloP">Título:</label>
                            <input id="TituloP" name="TituloP" class="form-control" <?php if(isset($errores) && in_array("TituloP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloP"])?$_POST["TituloP"]:$row['TituloP']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CongresoP">Congreso:</label>
                            <input id="CongresoP" name="CongresoP" class="form-control" <?php if(isset($errores) && in_array("CongresoP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CongresoP"])?$_POST["CongresoP"]:$row['CongresoP']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaIniCP">Fecha Inicio:</label>
                            <input id="FechaIniCP" type="date" name="FechaIniCP" class="form-control "<?php if(isset($errores) && in_array("FechaIniCP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaIniCP"])?$_POST["FechaIniCP"]:$row['FechaIniCP']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaFinCP">Fecha Fin:</label>
                            <input id="FechaFinCP" type="date" name="FechaFinCP" class="form-control "<?php if(isset($errores) && in_array("FechaFinCP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaFinCP"])?$_POST["FechaFinCP"]:$row['FechaFinCP']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="LugarP">Lugar:</label>
                            <input id="LugarP" name="LugarP" class="form-control" <?php if(isset($errores) && in_array("LugarP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["LugarP"])?$_POST["LugarP"]:$row['LugarP']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="PaisP">País:</label>
                            <input id="PaisP" name="PaisP" class="form-control" <?php if(isset($errores) && in_array("PaisP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PaisP"])?$_POST["PaisP"]:$row['PaisP']?>" >
                        </div>

                        <br>

                        <div class="text-center">
                            <input type="hidden" name="evento" value="modificarTad">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarPonencia();">
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
<!-- Confirmar modificar Ponencia -->
<div id="confirmModificarPonencia" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos de la ponencia?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar ponencia-->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarPonencia"]);
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>