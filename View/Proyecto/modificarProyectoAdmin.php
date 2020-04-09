
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
                $rows = $_SESSION["consultarProyecto"];

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

                    <form id="formularioModificarProyecto" action="index.php?controlador=Proyectos" method="post">

                        <!-- proyecto dirigido -->

                        <h2 class="text-center">Modificar proyecto </h2>

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
                            <label class="control-label" for="CodigoProy">Codigo proyecto: </label>
                            <input id="CodigoProy2" name="CodigoProy2"  class="form-control " value="<?php echo $row['CodigoProy']; ?>" disabled >
                            <input id="CodigoProy" name="CodigoProy" class="hidden" value="<?php echo $row['CodigoProy']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TituloProy">Título:</label>
                            <input id="TituloProy" name="TituloProy" class="form-control" <?php if(isset($errores) && in_array("TituloProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloProy"])?$_POST["TituloProy"]:$row['TituloProy']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="EntidadFinanciadora">Entidad Financiadora:</label>
                            <input id="EntidadFinanciadora" name="EntidadFinanciadora" class="form-control"<?php if(isset($errores) && in_array("EntidadFinanciadora", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["EntidadFinanciadora"])?$_POST["EntidadFinanciadora"]:$row['EntidadFinanciadora']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AcronimoProy">Acronimo:</label>
                            <input id="AcronimoProy"  name="AcronimoProy" class="form-control "<?php if(isset($errores) && in_array("AcronimoProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AcronimoProy"])?$_POST["AcronimoProy"]:$row['AcronimoProy']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AnhoInicioProy">Año inicio:</label>
                            <input id="AnhoInicioProy" name="AnhoInicioProy" class="form-control " <?php if(isset($errores) && in_array("AnhoInicioProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoInicioProy"])?$_POST["AnhoInicioProy"]:$row['AnhoInicioProy']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AnhoFinProy">Año fin:</label>
                            <input id="AnhoFinProy" name="AnhoFinProy" class="form-control " <?php if(isset($errores) && in_array("AnhoFinProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoFinProy"])?$_POST["AnhoFinProy"]:$row['AnhoFinProy']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="Importe">Importe:</label>
                            <input id="Importe" name="Importe" class="form-control " <?php if(isset($errores) && in_array("Importe", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Importe"])?$_POST["Importe"]:$row['Importe']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoParticipacionProy">Tipo de participación:</label>
                            <p> <select class="form-control" id="TipoParticipacionProy" name="TipoParticipacionProy">
                                    <option value="">--</option>
                                    <?php
                                    if(isset($errores)){
                                        ?>
                                        <option <?php if(isset($_POST["TipoParticipacionProy"]) && $_POST["TipoParticipacionProy"] == "Investigador"){ echo "selected"; } ?>>Investigador</option>
                                        <option <?php if(isset($_POST["TipoParticipacionProy"]) && $_POST["TipoParticipacionProy"] == "Investigador Principal"){ echo "selected"; } ?>>Investigador Principal</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option <?php if($row["TipoParticipacionProy"] == "Investigador"){ echo "selected"; } ?>>Investigador</option>
                                        <option <?php if($row["TipoParticipacionProy"] == "Investigador Principal"){ echo "selected"; } ?>>Investigador Principal</option>
                                        <?php
                                    }
                                    ?>

                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AdjuntoProy">Adjunto</label>
                            <input id="AdjuntoProy" name="AdjuntoProy" type="file" class="form-control <?php if(isset($errores) && in_array("AdjuntoProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AdjuntoProy"])?$_POST["AdjuntoProy"]:$row['AdjuntoProy']?>" >
                            <?php
                            if(!empty($row["AdjuntoProy"])){

                                $url = "Archivos/proyectos/".$row["AdjuntoProy"];                            ?>

                                <div class="text-center" style="margin:20px auto;">
                                    <input type="hidden" name="AdjuntoProy_old" value="<?=$row["AdjuntoProy"]?>">
                                    <a href='<?=$url?>' target='_blank'>Ver adjunto</a>
                                    <br>
                                    <label>
                                        <input type="checkbox" value="1" name="AdjuntoProy_delete">
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
                            <input type="hidden" name="evento" value="modificarProyecto">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarProyecto();">
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
<!-- Confirmar modificar proyecto -->
<div id="confirmModificarProyecto" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos del proyecto?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar proyecto -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarProyecto"]);

// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

