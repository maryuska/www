
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
                $rows = $_SESSION["consultarCongreso"];

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

                    <form id="formulario" action="index.php?controlador=Congresos" method="post">

                        <!-- Docente -->

                        <h2 class="text-center">Modificar congreso </h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoM">Codigo congreso: </label>
                            <input id="CodigoC" name="CodigoC"  class="form-control " value="<?php echo $row['CodigoC']; ?>" disabled >
                            <input id="CodigoC" name="CodigoC" class="hidden" value="<?php echo $row['CodigoC']; ?>" >
                            <input id="Login" name="Login" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="NombreC">Nombre:</label>
                            <input id="NombreC" name="NombreC" class="form-control" value="<?php echo $row['NombreC']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AcronimoC">Acronimo:</label>
                            <input id="AcronimoC" name="AcronimoC" class="form-control" value="<?php echo $row['AcronimoC']; ?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AnhoC">Año :</label>
                            <input id="AnhoC" name="AnhoC" class="form-control " value="<?php echo $row['AnhoC']; ?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="LugarC">Lugar:</label>
                            <input id="LugarC" name="LugarC" class="form-control " value="<?php echo $row['LugarC']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoParticipacionC">Participación:</label>
                            <p> <select class="form-control"  id="TipoParticipacionC" name="TipoParticipacionC">
                                    <option> <?php echo $row['TipoParticipacionC']; ?> </option>
                                    <option>-----------------------</option>
                                    <option>MCO</option>
                                    <option>MCC</option>
                                    <option>R</option>
                                    <option>C</option>
                                    <option>PCO</option>
                                    <option>PCC</option>
                                </select></p>
                        </div>


                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-orange" name="evento" value="modificarCongreso">
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

