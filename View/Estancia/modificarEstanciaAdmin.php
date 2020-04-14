
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

                    <form id="formularioModificarEstancia" action="index.php?controlador=Estancias" method="post">

                        <!-- Estancia -->

                        <h2 class="text-center">Modificar Estancia</h2>

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
                            <label class="control-label" for="CodigoE">Codigo estancia: </label>
                            <input id="CodigoE2" name="CodigoE2"  class="form-control " value="<?php echo $row['CodigoE']; ?>" disabled >
                            <input id="CodigoE" name="CodigoE" class="hidden" value="<?php echo $row['CodigoE']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" class="hidden" value="<?php echo $row['LoginU']; ?>" >
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
                            <p> <select class="form-control" id="TipoE" name="TipoE">
                                    <option value="">--</option>
                                    <?php
                                    if(isset($errores)){
                                        ?>
                                        <option <?php if(isset($_POST["TipoE"]) && $_POST["TipoE"] == "Investigacion"){ echo "selected"; } ?>>Investigacion</option>
                                        <option <?php if(isset($_POST["TipoE"]) && $_POST["TipoE"] == "Doctorado"){ echo "selected"; } ?>>Doctorado</option>
                                        <option <?php if(isset($_POST["TipoE"]) && $_POST["TipoE"] == "R"){ echo "selected"; } ?>>R</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option <?php if($row["TipoE"] == "Investigacion"){ echo "selected"; } ?>>Investigacion</option>
                                        <option <?php if($row["TipoE"] == "Doctorado"){ echo "selected"; } ?>>Doctorado</option>
                                        <option <?php if($row["TipoE"] == "Invitado"){ echo "selected"; } ?>>Invitado</option>
                                        <?php
                                    }
                                    ?>

                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AdjuntoE">Adjunto</label>
                            <input id="AdjuntoE" name="AdjuntoE" type="file" class="form-control <?php if(isset($errores) && in_array("AdjuntoE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AdjuntoE"])?$_POST["AdjuntoE"]:$row['AdjuntoE']?>" >
                            <?php
                            if(!empty($row["AdjuntoE"])){

                                $url = "Archivos/estancias/".$row["AdjuntoE"];                            ?>

                                <div class="text-center" style="margin:20px auto;">
                                    <input type="hidden" name="AdjuntoE_old" value="<?=$row["AdjuntoE"]?>">
                                    <a href='<?=$url?>' target='_blank'>Ver adjunto</a>
                                    <br>
                                    <label>
                                        <input type="checkbox" value="1" name="AdjuntoE_delete">
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
                            <input type="hidden" name="evento" value="modificarEstancia">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarEstancia();">
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

<!-- Confirmar modificar estancia -->
<div id="confirmModificarEstancia" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos de la estancia?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar estancia -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarEstancia"]);
unset($_SESSION["listarUsuarios"]);
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

