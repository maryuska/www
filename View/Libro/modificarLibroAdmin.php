
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
                $rows = $_SESSION["consultarLibro"];

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

                    <form id="formularioModificarLibro" action="index.php?controlador=Libros" method="post">

                        <!-- Libro -->

                        <h2 class="text-center">Modificar Libro</h2>

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
                            <label class="control-label" for="CodigoL">Codigo libro: </label>
                            <input id="CodigoL2" name="CodigoL2"  class="form-control " value="<?php echo $row['CodigoL']; ?>" disabled >
                            <input id="CodigoL" name="CodigoL" class="hidden" value="<?php echo $row['CodigoL']; ?>" >
                            <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                            <input id="LoginU_ant" name="LoginU_ant" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="AutoresL">Autores libro:</label>
                            <input id="AutoresL" name="AutoresL" class="form-control" <?php if(isset($errores) && in_array("AutoresL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AutoresL"])?$_POST["AutoresL"]:$row['AutoresL']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TituloL">Título libro:</label>
                            <input id="TituloL" name="TituloL" class="form-control" <?php if(isset($errores) && in_array("TituloL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloL"])?$_POST["TituloL"]:$row['TituloL']?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="ISBN">ISBN:</label>
                            <input id="ISBN" name="ISBN" class="form-control" <?php if(isset($errores) && in_array("ISBN", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["ISBN"])?$_POST["ISBN"]:$row['ISBN']?>"  >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="PagIniL">Pagina de Inicio:</label>
                            <input id="PagIniL"  name="PagIniL" class="form-control <?php if(isset($errores) && in_array("PagIniL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PagIniL"])?$_POST["PagIniL"]:$row['PagIniL']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="PagFinL">Pagina de Fin:</label>
                            <input id="PagFinL"  name="PagFinL" class="form-control <?php if(isset($errores) && in_array("PagFinL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PagFinL"])?$_POST["PagFinL"]:$row['PagFinL']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="VolumenL">Vólumen:</label>
                            <input id="VolumenL"  name="VolumenL" class="form-control <?php if(isset($errores) && in_array("VolumenL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["VolumenL"])?$_POST["VolumenL"]:$row['VolumenL']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="EditorialL">Editorial:</label>
                            <input id="EditorialL"  name="EditorialL" class="form-control <?php if(isset($errores) && in_array("EditorialL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["EditorialL"])?$_POST["EditorialL"]:$row['EditorialL']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="FechaPublicacionL">Fecha publicación:</label>
                            <input id="FechaPublicacionL" type="date" name="FechaPublicacionL" class="form-control <?php if(isset($errores) && in_array("FechaPublicacionL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaPublicacionL"])?$_POST["FechaPublicacionL"]:$row['FechaPublicacionL']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="EditorL">Editor:</label>
                            <input id="EditorL"  name="EditorL" class="form-control <?php if(isset($errores) && in_array("EditorL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["EditorL"])?$_POST["EditorL"]:$row['EditorL']?>" >
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="PaisEdicionL">País edición:</label>
                            <input id="PaisEdicionL"  name="PaisEdicionL" class="form-control <?php if(isset($errores) && in_array("PaisEdicionL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PaisEdicionL"])?$_POST["PaisEdicionL"]:$row['PaisEdicionL']?>" >
                        </div>

                        <br>

                        <div class="text-center">
                            <input type="hidden" name="evento" value="modificarLibro">
                            <button type="button" class="btn btn-orange" onclick="abrirConfirmModificarLibro();">
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

<!-- Confirmar modificar libro -->
<div id="confirmModificarLibro" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Está seguro@ que desea modificar los datos del libro?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="modificar">Modificar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar modificar libro -->

<?php
// Eliminamos los datos cargados en session para la consulta
unset($_SESSION["consultarLibro"]);
unset($_SESSION["listarUsuarios"]);
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>

