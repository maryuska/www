
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

                    <form id="formularioModificarCongreso" action="index.php?controlador=Congresos" method="post">

                        <!-- Docente -->

                        <h2 class="text-center">Modificar congreso</h2>

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
                            <label class="control-label" for="CodigoM">Codigo congreso: </label>
                            <input id="CodigoC2" name="CodigoC2" class="form-control " value="<?php echo $row['CodigoC']; ?>" disabled >
                            <input id="CodigoC" name="CodigoC" type="hidden" value="<?php echo $row['CodigoC']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" type="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="NombreC">Nombre:</label>
                            <input id="NombreC" name="NombreC" class="form-control <?php if(isset($errores) && in_array("NombreC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["NombreC"])?$_POST["NombreC"]:$row['NombreC']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AcronimoC">Acronimo:</label>
                            <input id="AcronimoC" name="AcronimoC" class="form-control <?php if(isset($errores) && in_array("AcronimoC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AcronimoC"])?$_POST["AcronimoC"]:$row['AcronimoC']?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AnhoC">Año :</label>
                            <input id="AnhoC" name="AnhoC" class="form-control <?php if(isset($errores) && in_array("AnhoC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoC"])?$_POST["AnhoC"]:$row['AnhoC']?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="LugarC">Lugar:</label>
                            <input id="LugarC" name="LugarC" class="form-control <?php if(isset($errores) && in_array("LugarC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["LugarC"])?$_POST["LugarC"]:$row['LugarC']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoParticipacionC">Participación:</label>
                            <p> <select class="form-control" id="TipoParticipacionC" name="TipoParticipacionC">
                                    <option value="">--</option>
                                    <?php
                                    if(isset($errores)){
                                    ?>
                                        <option <?php if(isset($_POST["TipoParticipacionC"]) && $_POST["TipoParticipacionC"] == "MCO"){ echo "selected"; } ?>>MCO</option>
                                        <option <?php if(isset($_POST["TipoParticipacionC"]) && $_POST["TipoParticipacionC"] == "MCC"){ echo "selected"; } ?>>MCC</option>
                                        <option <?php if(isset($_POST["TipoParticipacionC"]) && $_POST["TipoParticipacionC"] == "R"){ echo "selected"; } ?>>R</option>
                                        <option <?php if(isset($_POST["TipoParticipacionC"]) && $_POST["TipoParticipacionC"] == "C"){ echo "selected"; } ?>>C</option>
                                        <option <?php if(isset($_POST["TipoParticipacionC"]) && $_POST["TipoParticipacionC"] == "PCO"){ echo "selected"; } ?>>PCO</option>
                                        <option <?php if(isset($_POST["TipoParticipacionC"]) && $_POST["TipoParticipacionC"] == "PCC"){ echo "selected"; } ?>>PCC</option>
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <option <?php if($row["TipoParticipacionC"] == "MCO"){ echo "selected"; } ?>>MCO</option>
                                        <option <?php if($row["TipoParticipacionC"] == "MCC"){ echo "selected"; } ?>>MCC</option>
                                        <option <?php if($row["TipoParticipacionC"] == "R"){ echo "selected"; } ?>>R</option>
                                        <option <?php if($row["TipoParticipacionC"] == "C"){ echo "selected"; } ?>>C</option>
                                        <option <?php if($row["TipoParticipacionC"] == "PCO"){ echo "selected"; } ?>>PCO</option>
                                        <option <?php if($row["TipoParticipacionC"] == "PCC"){ echo "selected"; } ?>>PCC</option>
                                    <?php
                                    }
                                    ?>

                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AdjuntoC">Adjunto</label>
                            <input id="AdjuntoC" name="AdjuntoC" type="file" class="form-control <?php if(isset($errores) && in_array("AdjuntoC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AdjuntoC"])?$_POST["AdjuntoC"]:$row['AdjuntoC']?>" >
                            <?php
                            if(!empty($row["AdjuntoC"])){

                                $url = "Archivos/congresos/".$row["AdjuntoC"];                            ?>

                                <div class="text-center" style="margin:20px auto;">
                                    <input type="hidden" name="AdjuntoC_old" value="<?=$row["AdjuntoC"]?>">
                                    <a href='<?=$url?>' target='_blank'>Ver adjunto</a>
                                    <br>
                                    <label>
                                        <input type="checkbox" value="1" name="AdjuntoC_delete">
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
                            <input type="hidden" name="evento" value="modificarCongreso">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarCongreso();">
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

<!-- Confirmar modificar congreso -->
<div id="confirmModificarCongreso" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos del congreso?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>                    
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar congreso -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarCongreso"]);

// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

