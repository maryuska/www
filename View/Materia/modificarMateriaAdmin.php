
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

                    <form id="formularioModificarMateria" action="index.php?controlador=Materias" method="post">

                        <!-- Docente -->

                        <h2 class="text-center">Modificar Materia</h2>

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
                            <label class="control-label" for="CodigoM">Codigo materia: </label>
                            <input id="CodigoM2" name="CodigoM2"  class="form-control " value="<?php echo $row['CodigoM']; ?>" disabled >
                            <input id="CodigoM" name="CodigoM" class="hidden" value="<?php echo $row['CodigoM']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoM">Tipo de materia:</label>
                            <p> <select class="form-control" id="TipoM" name="TipoM">
                                    <option value="">--</option>
                                    <?php
                                    if(isset($errores)){
                                        ?>
                                        <option <?php if(isset($_POST["TipoM"]) && $_POST["TipoM"] == "Grado"){ echo "selected"; } ?>>Grado</option>
                                        <option <?php if(isset($_POST["TipoM"]) && $_POST["TipoM"] == "Tercer Ciclo"){ echo "selected"; } ?>>Tercer Ciclo</option>
                                        <option <?php if(isset($_POST["TipoM"]) && $_POST["TipoM"] == "Curso"){ echo "selected"; } ?>>Curso</option>
                                        <option <?php if(isset($_POST["TipoM"]) && $_POST["TipoM"] == "Master"){ echo "selected"; } ?>>Master</option>
                                        <option <?php if(isset($_POST["TipoM"]) && $_POST["TipoM"] == "PostGrado"){ echo "selected"; } ?>>PostGrado</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option <?php if($row["TipoM"] == "Grado"){ echo "selected"; } ?>>Grado</option>
                                        <option <?php if($row["TipoM"] == "Tercer Ciclo"){ echo "selected"; } ?>>Tercer Ciclo</option>
                                        <option <?php if($row["TipoM"] == "Curso"){ echo "selected"; } ?>>Curso</option>
                                        <option <?php if($row["TipoM"] == "Master"){ echo "selected"; } ?>>Master</option>
                                        <option <?php if($row["TipoM"] == "PostGrado"){ echo "selected"; } ?>>PostGrado</option>
                                        <?php
                                    }
                                    ?>

                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoParticipacionM">Tipo de participación:</label>
                            <p> <select class="form-control" id="TipoParticipacionM" name="TipoParticipacionM">
                                    <option value="">--</option>
                                    <?php
                                    if(isset($errores)){
                                        ?>
                                        <option <?php if(isset($_POST["TipoParticipacionM"]) && $_POST["TipoParticipacionM"] == "Director"){ echo "selected"; } ?>>Director</option>
                                        <option <?php if(isset($_POST["TipoParticipacionM"]) && $_POST["TipoParticipacionM"] == "Docente"){ echo "selected"; } ?>>Docente</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option <?php if($row["TipoParticipacionM"] == "Director"){ echo "selected"; } ?>>Director</option>
                                        <option <?php if($row["TipoParticipacionM"] == "Docente"){ echo "selected"; } ?>>Docente</option>
                                        <?php
                                    }
                                    ?>

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
                            <p> <select class="form-control" id="CuatrimestreM" name="CuatrimestreM">
                                    <option value="">--</option>
                                    <?php
                                    if(isset($errores)){
                                        ?>
                                        <option <?php if(isset($_POST["CuatrimestreM"]) && $_POST["CuatrimestreM"] == "Primero"){ echo "selected"; } ?>>Primero</option>
                                        <option <?php if(isset($_POST["CuatrimestreM"]) && $_POST["CuatrimestreM"] == "Segundo"){ echo "selected"; } ?>>Segundo</option>
                                        <option <?php if(isset($_POST["CuatrimestreM"]) && $_POST["CuatrimestreM"] == "Anual"){ echo "selected"; } ?>>Anual</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option <?php if($row["CuatrimestreM"] == "Primero"){ echo "selected"; } ?>>Primero</option>
                                        <option <?php if($row["CuatrimestreM"] == "Segundo"){ echo "selected"; } ?>>Segundo</option>
                                        <option <?php if($row["CuatrimestreM"] == "Anual"){ echo "selected"; } ?>>Anual</option>
                                        <?php
                                    }
                                    ?>

                                </select></p>
                        </div>
                        <br>

                        <div class="text-center">
                            <input type="hidden" name="evento" value="modificarMateria">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarMateria();">
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
<!-- Confirmar modificar materia -->
<div id="confirmModificarMateria" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos de la materia?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar materia -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarMateria"]);
unset($_SESSION["listarUsuarios"]);
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

