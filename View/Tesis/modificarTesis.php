
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

                    <form id="formulario" action="index.php?controlador=Tesis" method="post">

                        <!--  -->

                        <h2 class="text-center">Modificar Tesis</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoTesis">Codigo Tesis: </label>
                            <input id="CodigoTesis" name="CodigoTesis"  class="form-control " value="<?php echo $row['CodigoTesis']; ?>" disabled >
                            <input id="CodigoTesis" name="CodigoTesis" class="hidden" value="<?php echo $row['CodigoTesis']; ?>" >
                            <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
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
                            <label class="control-label" for="CalificacionTesis">Calificación:</label>
                            <p> <select class="form-control"  id="CalificacionTesis" name="CalificacionTesis">
                                    <option> <?php echo $row['CalificacionTesis']; ?> </option>
                                    <option>------------------------</option>
                                    <option>Aprobado</option>
                                    <option>Notable</option>
                                    <option>Sobresaliente</option>
                                    <option>Matricula</option>
                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="URLTesis">URL:</label>
                            <input id="URLTesis" name="URLTesis" class="form-control" <?php if(isset($errores) && in_array("URLTesis", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["URLTesis"])?$_POST["URLTesis"]:$row['URLTesis']?>" >
                        </div>
                        <br>


                        <div class="text-center">
                            <button type="submit" class="btn btn-orange" name="evento" value="modificarTesis">
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

