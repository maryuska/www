
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

                    <form id="formulario" action="index.php?controlador=Tad" method="post">

                        <!-- Docente -->

                        <h2 class="text-center">Modificar Tad</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoTAD">Codigo Tad: </label>
                            <input id="CodigoTAD" name="CodigoTAD"  class="form-control " value="<?php echo $row['CodigoTAD']; ?>" disabled >
                            <input id="CodigoTAD" name="CodigoTAD" class="hidden" value="<?php echo $row['CodigoTAD']; ?>" >
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

                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-orange" name="evento" value="modificarTad">
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

<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

