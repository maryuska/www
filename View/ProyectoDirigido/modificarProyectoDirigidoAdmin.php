
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

                    <form id="formularioModificarProyectoDirigido" enctype="multipart/form-data" action="index.php?controlador=ProyectosDirigidos" method="post">

                        <!-- proyecto dirigido -->

                        <h2 class="text-center">Modificar proyecto dirigido</h2>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="LoginU">Login usuario</label>
                            <select id="LoginU" name="LoginU" type="text" placeholder="Login usuario" class="form-control <?php if(isset($errores) && in_array("LoginU", $errores)){ echo " error"; } ?>">
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
                            <label class="control-label" for="CodigoM">Codigo proyecto: </label>
                            <input id="CodigoPD2" name="CodigoPD2"  class="form-control" value="<?php echo $row['CodigoPD']; ?>" disabled >
                            <input id="CodigoPD" name="CodigoPD" class="hidden" value="<?php echo $row['CodigoPD']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" type="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TituloPD">Titulo:</label>
                            <input id="TituloPD" name="TituloPD" class="form-control <?php if(isset($errores) && in_array("TituloPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloPD"])?$_POST["TituloPD"]:$row['TituloPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AlumnoPD">Alumno:</label>
                            <input id="AlumnoPD" name="AlumnoPD" class="form-control <?php if(isset($errores) && in_array("AlumnoPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AlumnoPD"])?$_POST["AlumnoPD"]:$row['AlumnoPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaLecturaPD">Fecha lectura:</label>
                            <input id="FechaLecturaPD" type="date" name="FechaLecturaPD" class="form-control <?php if(isset($errores) && in_array("FechaLecturaPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaLecturaPD"])?$_POST["FechaLecturaPD"]:$row['FechaLecturaPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CalificacionPD">Calificación:</label>
                            <p> <select class="form-control <?php if(isset($errores) && in_array("CalificacionPD", $errores)){ echo " error"; } ?>" id="CalificacionPD" name="CalificacionPD">

                                    <option value="">------------------------</option>

                                    <?php
                                    if(isset($errores)){
                                    ?>
                                        <option value="Aprobado" <?php if(isset($_POST["CalificacionPD"]) && $_POST["CalificacionPD"] == "Aprobado"){ echo "selected"; } ?>>Aprobado</option>
                                        <option value="Notable" <?php if(isset($_POST["CalificacionPD"]) && $_POST["CalificacionPD"] == "Notable"){ echo "selected"; } ?>>Notable</option>
                                        <option value="Sobresaliente" <?php if(isset($_POST["CalificacionPD"]) && $_POST["CalificacionPD"] == "Sobresaliente"){ echo "selected"; } ?>>Sobresaliente</option>
                                        <option value="Matricula" <?php if(isset($_POST["CalificacionPD"]) && $_POST["CalificacionPD"] == "Matricula"){ echo "selected"; } ?>>Matricula</option>
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <option <?php if($row["CalificacionPD"] == "Aprobado"){ echo "selected"; } ?>>Aprobado</option>
                                        <option <?php if($row["CalificacionPD"] == "Notable"){ echo "selected"; } ?>>Notable</option>
                                        <option <?php if($row["CalificacionPD"] == "Sobresaliente"){ echo "selected"; } ?>>Sobresaliente</option>
                                        <option <?php if($row["CalificacionPD"] == "Matricula"){ echo "selected"; } ?>>Matricula</option>
                                    <?php
                                    }
                                    ?>

                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="URLPD">URL:</label>
                            <input id="URLPD" name="URLPD" class="form-control <?php if(isset($errores) && in_array("URLPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["URLPD"])?$_POST["URLPD"]:$row['URLPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="CotutorPD">Cotutor:</label>
                            <input id="CotutorPD" name="CotutorPD" class="form-control <?php if(isset($errores) && in_array("CotutorPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CotutorPD"])?$_POST["CotutorPD"]:$row['CotutorPD']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TipoPD">Tipo de proyeco:</label>
                            <p> <select class="form-control  <?php if(isset($errores) && in_array("TipoPD", $errores)){ echo " error"; } ?>"  id="TipoPD" name="TipoPD">

                                    <option value="">------------------------</option>
    
                                    <?php
                                    if(isset($errores)){
                                    ?>
                                        <option value="PFC" <?php if(isset($_POST["TipoPD"]) && $_POST["TipoPD"] == "PFC"){ echo "selected"; } ?>>PFC</option>
                                        <option value="TFG" <?php if(isset($_POST["TipoPD"]) && $_POST["TipoPD"] == "TFG"){ echo "selected"; } ?>>TFG</option>
                                        <option value="TFM" <?php if(isset($_POST["TipoPD"]) && $_POST["TipoPD"] == "TFM"){ echo "selected"; } ?>>TFM</option>
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <option <?php if($row["TipoPD"] == "PFC"){ echo "selected"; } ?>>PFC</option>
                                        <option <?php if($row["TipoPD"] == "TFG"){ echo "selected"; } ?>>TFG</option>
                                        <option <?php if($row["TipoPD"] == "TFM"){ echo "selected"; } ?>>TFM</option>
                                    <?php
                                    }
                                    ?>

                                </select></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AdjuntoPD">Adjunto</label>
                            <input id="AdjuntoPD" name="AdjuntoPD" type="file" class="form-control <?php if(isset($errores) && in_array("AdjuntoPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AdjuntoPD"])?$_POST["AdjuntoPD"]:''?>" >
                            <?php 
                            if(!empty($row["AdjuntoPD"])){

                                $url = "Archivos/proyectos_dirigidos/".$row["AdjuntoPD"];                            ?>
                            
                                <div class="text-center" style="margin:20px auto;">
                                    <input type="hidden" name="AdjuntoPD_old" value="<?=$row["AdjuntoPD"]?>">
                                    <a href='<?=$url?>' target='_blank'>Ver adjunto</a>
                                    <br>
                                    <label>
                                        <input type="checkbox" value="1" name="AdjuntoPD_delete">
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
                            <input type="hidden" name="evento" value="modificarProyectosDirigidos">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarProyectoDirigido();">
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

<!-- Confirmar modificar proyecto dirigido -->
<div id="confirmModificarProyectoDirigido" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos del proyecto dirigido?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>                    
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar proyecto dirigido -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarProyectoDirigido"]);
unset($_SESSION["listarUsuarios"]);

// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

