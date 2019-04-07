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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarProyectoDirigido()"  action="index.php?controlador=ProyectosDirigidos" method="post">

                    <!-- proyecto dirigido -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Proyecto dirigido</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoM">Código proyecto</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoPD" name="CodigoPD" type="text" placeholder="Codigo proyecto" class="form-control <?php if(isset($errores) && in_array("CodigoPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoPD"])?$_POST["CodigoPD"]:''?>" >
                            <input id="LoginU" name="LoginU" type="text" class="hidden" value="<?php echo $loginU; ?>"  >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TituloPD">Título</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TituloPD" name="TituloPD" type="text" placeholder="Titulo" class="form-control <?php if(isset($errores) && in_array("TituloPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloPD"])?$_POST["TituloPD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AlumnoPD">Alumno</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AlumnoPD" name="AlumnoPD" type="text" placeholder="Alumno" class="form-control <?php if(isset($errores) && in_array("AlumnoPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AlumnoPD"])?$_POST["AlumnoPD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaLecturaPD">Fecha lectura</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaLecturaPD" name="FechaLecturaPD" type="date" placeholder="Fecha lectura" class="form-control <?php if(isset($errores) && in_array("FechaLecturaPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaLecturaPD"])?$_POST["FechaLecturaPD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CalificacionPD">Calificación</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="CalificacionPD" name="CalificacionPD" type="text" placeholder="Cslificacion" class="form-control <?php if(isset($errores) && in_array("CalificacionPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CalificacionPD"])?$_POST["CalificacionPD"]:''?>">
                                    <option>--</option>
                                    <option>Aprobado</option>
                                    <option>Notable</option>
                                    <option>Sobresaliente</option>
                                    <option>Matricula</option>
                                </select></p>
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="URLPD">URL</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="URLPD" name="URLPD" type="text" placeholder="URL" class="form-control <?php if(isset($errores) && in_array("URLPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["URLPD"])?$_POST["URLPD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CotutorPD">Cotutor</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CotutorPD" name="CotutorPD" type="text" placeholder="Cotutor" class="form-control <?php if(isset($errores) && in_array("CotutorPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CotutorPD"])?$_POST["CotutorPD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TipoPD">Tipo proyecto</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="TipoPD" name="TipoPD" type="text" placeholder="Tipo proyecto" class="form-control <?php if(isset($errores) && in_array("TipoPD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoPD"])?$_POST["TipoPD"]:''?>">
                                    <option>--</option>
                                    <option >PFC</option>
                                    <option >TFG</option>
                                    <option>TFM</option>
                                </select></p>
                        </div>
                    </div>

                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaProyectoDirigido" name="evento" value="altaProyectoDirigido" class="btn btn-orange">
                            Alta proyecto dirigido
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