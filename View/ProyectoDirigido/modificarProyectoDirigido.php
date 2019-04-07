
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
                $rows = $_SESSION["consultarProyectoDirigido"];

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

                    <form id="formulario" action="index.php?controlador=ProyectosDirigidos" method="post">

                        <!-- proyecto dirigido -->

                        <h2 class="text-center">Modificar proyecto dirigido</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoM">Codigo proyecto: </label>
                            <input id="CodigoPD" name="CodigoPD"  class="form-control " value="<?php echo $row['CodigoPD']; ?>" disabled >
                            <input id="CodigoPD" name="CodigoPD" class="hidden" value="<?php echo $row['CodigoPD']; ?>" >
                            <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TituloPD">Titulo:</label>
                            <input id="TituloPD" name="TituloPD" class="form-control" <?php if(isset($errores) && in_array("TituloPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloPD"])?$_POST["TituloPD"]:$row['TituloPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AlumnoPD">Alumno:</label>
                            <input id="AlumnoPD" name="AlumnoPD" class="form-control"<?php if(isset($errores) && in_array("AlumnoPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AlumnoPD"])?$_POST["AlumnoPD"]:$row['AlumnoPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaLecturaPD">Fecha lectura:</label>
                            <input id="FechaLecturaPD" type="date" name="FechaLecturaPD" class="form-control "<?php if(isset($errores) && in_array("FechaLecturaPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaLecturaPD"])?$_POST["FechaLecturaPD"]:$row['FechaLecturaPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CalificacionPD">Calificación:</label>
                            <p> <select class="form-control"  id="CalificacionPD" name="CalificacionPD">
                                    <option> <?php echo $row['CalificacionPD']; ?> </option>
                                    <option>------------------------</option>
                                    <option>Aprobado</option>
                                    <option>Notable</option>
                                    <option>Sobresaliente</option>
                                    <option>Matricula</option>
                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="URLPD">URL:</label>
                            <input id="URLPD" name="URLPD" class="form-control " <?php if(isset($errores) && in_array("URLPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["URLPD"])?$_POST["URLPD"]:$row['URLPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CotutorPD">Cotutor:</label>
                            <input id="CotutorPD" name="CotutorPD" class="form-control " <?php if(isset($errores) && in_array("CotutorPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CotutorPD"])?$_POST["CotutorPD"]:$row['CotutorPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoPD">Tipo de proyeco:</label>
                            <p> <select class="form-control"  id="TipoPD" name="TipoPD">
                                    <option> <?php echo $row['TipoPD']; ?> </option>
                                    <option>------------------------</option>
                                    <option >PFC</option>
                                    <option >TFG</option>
                                    <option>TFM</option>
                                </select></p>
                        </div>

                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-orange" name="evento" value="modificarProyectoDirigido">
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

