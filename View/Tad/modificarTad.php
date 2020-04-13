
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
                $rows = $_SESSION["consultarTad"];

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

                    <form id="formularioModificarTAD" action="index.php?controlador=Tad" method="post">

                        <!-- Docente -->

                        <h2 class="text-center">Modificar Tad</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoTAD">Codigo Tad: </label>
                            <input id="CodigoTAD2" name="CodigoTAD2"  class="form-control " value="<?php echo $row['CodigoTAD']; ?>" disabled >
                            <input id="CodigoTAD" name="CodigoTAD" class="hidden" value="<?php echo $row['CodigoTAD']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                            <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TituloTAD">Título:</label>
                            <input id="TituloTAD" name="TituloTAD" class="form-control" <?php if(isset($errores) && in_array("TituloTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloTAD"])?$_POST["TituloTAD"]:$row['TituloTAD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AlumnoTAD">Alumno:</label>
                            <input id="AlumnoTAD" name="AlumnoTAD" class="form-control" <?php if(isset($errores) && in_array("AlumnoTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AlumnoTAD"])?$_POST["AlumnoTAD"]:$row['AlumnoTAD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaLecturaTAD">Fecha lectura:</label>
                            <input id="FechaLecturaTAD" type="date" name="FechaLecturaTAD" class="form-control "<?php if(isset($errores) && in_array("FechaLecturaTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaLecturaTAD"])?$_POST["FechaLecturaTAD"]:$row['FechaLecturaTAD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AdjuntoTAD">Adjunto</label>
                            <input id="AdjuntoTAD" name="AdjuntoTAD" type="file" class="form-control <?php if(isset($errores) && in_array("AdjuntoTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AdjuntoTAD"])?$_POST["AdjuntoTAD"]:$row['AdjuntoTAD']?>" >
                            <?php
                            if(!empty($row["AdjuntoTAD"])){

                                $url = "Archivos/tads/".$row["AdjuntoTAD"];                            ?>

                                <div class="text-center" style="margin:20px auto;">
                                    <input type="hidden" name="AdjuntoTAD_old" value="<?=$row["AdjuntoTAD"]?>">
                                    <a href='<?=$url?>' target='_blank'>Ver adjunto</a>
                                    <br>
                                    <label>
                                        <input type="checkbox" value="1" name="AdjuntoTAD_delete">
                                        Eliminar fichero adjunto
                                    </label>
                                    <br>
                                    <small>Si sube un fichero nuevo el anterior será eliminado.<small>
                                </div>

                                <?php
                            }
                            ?>

                        </div>

                        <br>

                        <div class="text-center">
                            <input type="hidden" name="evento" value="modificarTad">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarTAD();">
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
<!-- Confirmar modificar TAD -->
<div id="confirmModificarTAD" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos del TAD?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar TAD -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarMateria"]);
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

