<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';

$loginU =$_SESSION["loginU"];

?>
<div class="container-fluid">
    <div class="row">

        <?php
        // Menu lateral
        require_once 'View/Structure/Sidebar.php';
        ?>

        <!-- Contenido -->
        <div class="col-md-offset-1 col-md-8 col-lg-offset-2 col-lg-6">
            <div class="cotainer">
                <?php
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
                ?>

                <!-- Formulario -->

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarTad()"  action="index.php?controlador=Tesis" method="post">

                    <!-- tesis -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Tesis</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="LoginU">Tutor</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="LoginU" name="LoginU" type="text" placeholder="Login usuario" class="form-control <?php if(isset($errores) && in_array("LoginU", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["LoginU"])?$_POST["LoginU"]:''?>">
                                    <option>--</option>
                                    <?php $rows = $_SESSION["listarUsuarios"]; foreach ($rows as $row){ ?>
                                        <option value="<?php echo $row['LoginU'];?>"><?php echo $row['LoginU']." - ".$row['NombreU'];?></option>
                                    <?php } ?>
                                </select></p>
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoTesis">Código Tesis</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoTesis" name="CodigoTesis" type="text" placeholder="Codigo Tesis" class="form-control <?php if(isset($errores) && in_array("CodigoTesis", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoTesis"])?$_POST["CodigoTesis"]:''?>" >
                            <input id="LoginU" name="LoginU" type="text" class="hidden" value="<?php echo $loginU; ?>"  >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AutorTesis">Autor</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AutorTesis" name="AutorTesis" type="text" placeholder="Autor" class="form-control <?php if(isset($errores) && in_array("AutorTesis", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AutorTesis"])?$_POST["AutorTesis"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaInscripcion">Fecha inscripción</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaInscripcion" name="FechaInscripcion" type="date" placeholder="Fecha lectura" class="form-control <?php if(isset($errores) && in_array("FechaInscripcion", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaInscripcion"])?$_POST["FechaInscripcion"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaLectura">Fecha lectura</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaLectura" name="FechaLectura" type="date" placeholder="Fecha lectura" class="form-control <?php if(isset($errores) && in_array("FechaLectura", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaLectura"])?$_POST["FechaLectura"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CalificacionTesis">Calificación</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="CalificacionTesis" name="CalificacionTesis" type="text" placeholder="Calificacion" class="form-control <?php if(isset($errores) && in_array("CalificacionTesis", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CalificacionTesis"])?$_POST["CalificacionTesis"]:''?>">
                                    <option>--</option>
                                    <option>Aprobado</option>
                                    <option>Notable</option>
                                    <option>Sobresaliente</option>
                                    <option>Matricula</option>
                                </select></p>
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="URLTesis">URL</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="URLTesis" name="URLTesis" type="text" placeholder="URL" class="form-control <?php if(isset($errores) && in_array("URLTesis", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["URLTesis"])?$_POST["URLTesis"]:''?>" >
                        </div>
                    </div>





                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaTesis" name="evento" value="altaTesisAdmin" class="btn btn-orange">
                            Alta Tesis
                        </button>
                    </div>

                    <br>
                    <br>

                </form>

            </div>
        </div>
    </div>
</div>
</div>
<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>









