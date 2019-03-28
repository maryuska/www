
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
                $rows = $_SESSION["consultarEstancia"];

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

                    <form id="formulario" action="index.php?controlador=Estancias" method="post">

                        <!-- Estancia -->

                        <h2 class="text-center">Modificar Estancia</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoE">Codigo estancia: </label>
                            <input id="CodigoE" name="CodigoE"  class="form-control " value="<?php echo $row['CodigoE']; ?>" disabled >
                            <input id="CodigoE" name="CodigoE" class="hidden" value="<?php echo $row['CodigoE']; ?>" >
                            <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CentroE">Centro estancia:</label>
                            <input id="CentroE" name="CentroE" class="form-control" <?php if(isset($errores) && in_array("CentroE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CentroE"])?$_POST["CentroE"]:$row['CentroE']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="UniversidadE">Universidad:</label>
                            <input id="UniversidadE" name="UniversidadE" class="form-control" <?php if(isset($errores) && in_array("UniversidadE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["UniversidadE"])?$_POST["UniversidadE"]:$row['UniversidadE']?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="PaisE">Pais:</label>
                            <input id="PaisE" name="PaisE" class="form-control" <?php if(isset($errores) && in_array("PaisE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PaisE"])?$_POST["PaisE"]:$row['PaisE']?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaInicioE">Fecha Inicio:</label>
                             <input id="FechaInicioE" type="date" name="FechaInicioE" class="form-control <?php if(isset($errores) && in_array("FechaInicioE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaInicioE"])?$_POST["FechaInicioE"]:$row['FechaInicioE']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaFinE">Fecha Fin:</label>
                            <input id="FechaFinE" type="date" name="FechaFinE" class="form-control <?php if(isset($errores) && in_array("FechaFinE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaFinE"])?$_POST["FechaFinE"]:$row['FechaFinE']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoE">Tipo estancia:</label>
                            <p> <select class="form-control"  id="TipoE" name="TipoE">
                                    <option> <?php echo $row['TipoE']; ?> </option>
                                    <option>-----------------------</option>
                                    <option>Investigacion</option>
                                    <option>Doctorado</option>
                                    <option>Invitado</option>
                                </select></p>
                        </div>


                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-orange" name="evento" value="modificarEstancia">
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

