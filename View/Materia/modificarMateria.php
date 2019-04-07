
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
                $rows = $_SESSION["consultarMateria"];

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

                    <form id="formulario" action="index.php?controlador=Materias" method="post">

                        <!-- Docente -->

                        <h2 class="text-center">Modificar Materia</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="CodigoM">Codigo materia: </label>
                            <input id="CodigoM" name="CodigoM"  class="form-control " value="<?php echo $row['CodigoM']; ?>" disabled >
                            <input id="CodigoM" name="CodigoM" class="hidden" value="<?php echo $row['CodigoM']; ?>" >
                            <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoM">Tipo de materia:</label>
                            <p> <select class="form-control"  id="TipoM" name="TipoM">
                                    <option> <?php echo $row['TipoM']; ?> </option>
                                    <option>------------------------</option>
                                    <option>Grado</option>
                                    <option>Tercer Ciclo</option>
                                    <option>Curso</option>
                                    <option>Master</option>
                                    <option>PostGrado</option>
                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoParticipacionM">Tipo de participación:</label>
                            <p> <select class="form-control"  id="TipoParticipacionM" name="TipoParticipacionM">
                                    <option> <?php echo $row['TipoParticipacionM']; ?> </option>
                                    <option>------------------------</option>
                                    <option>Director</option>
                                    <option>Docente</option>
                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="DenominacionM">Denominación:</label>
                            <input id="DenominacionM" name="DenominacionM" class="form-control" <?php if(isset($errores) && in_array("DenominacionM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["DenominacionM"])?$_POST["DenominacionM"]:$row['DenominacionM']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TitulacionM">Titulación:</label>
                            <input id="TitulacionM" name="TitulacionM" class="form-control" <?php if(isset($errores) && in_array("TitulacionM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TitulacionM"])?$_POST["TitulacionM"]:$row['TitulacionM']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AnhoAcademicoM">Año académico:</label>
                            <input id="AnhoAcademicoM" type="date" name="AnhoAcademicoM" class="form-control "<?php if(isset($errores) && in_array("AnhoAcademicoM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoAcademicoM"])?$_POST["AnhoAcademicoM"]:$row['AnhoAcademicoM']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CreditosM">Creditos:</label>
                            <input id="CreditosM" name="CreditosM" class="form-control " <?php if(isset($errores) && in_array("CreditosM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CreditosM"])?$_POST["CreditosM"]:$row['CreditosM']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CuatrimestreM">Cuatrimestre:</label>
                            <p> <select class="form-control"  id="CuatrimestreM" name="CuatrimestreM">
                                    <option> <?php echo $row['CuatrimestreM']; ?> </option>
                                    <option>-----------------------</option>
                                    <option>Primero</option>
                                    <option>Segundo</option>
                                    <option>Anual</option>
                                </select></p>
                        </div>


                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-orange" name="evento" value="modificarMateria">
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

