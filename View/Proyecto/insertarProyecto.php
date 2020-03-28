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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarProyecto()"  action="index.php?controlador=Proyectos" method="post">

                    <!-- proyecto  -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Proyecto </h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoProy">Código proyecto</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoProy" name="CodigoProy" type="text" placeholder="Codigo proyecto" class="form-control <?php if(isset($errores) && in_array("CodigoProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoProy"])?$_POST["CodigoProy"]:''?>" >
                            <input id="Login" name="Login" type="text" class="hidden" value="<?php echo $loginU; ?>"  >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TituloProy">Título</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TituloProy" name="TituloProy" type="text" placeholder="Titulo" class="form-control <?php if(isset($errores) && in_array("TituloProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloProy"])?$_POST["TituloProy"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="EntidadFinanciadora">Entidad financiadora</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="EntidadFinanciadora" name="EntidadFinanciadora" type="text" placeholder="Entidad" class="form-control <?php if(isset($errores) && in_array("EntidadFinanciadora", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["EntidadFinanciadora"])?$_POST["EntidadFinanciadora"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AcronimoProy">Acrónimo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AcronimoProy" name="AcronimoProy" type="text" placeholder="Acrónimo" class="form-control <?php if(isset($errores) && in_array("AcronimoProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AcronimoProy"])?$_POST["AcronimoProy"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AnhoInicioProy">Año inicio</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AnhoInicioProy" name="AnhoInicioProy" type="date" placeholder="Año inicio" class="form-control <?php if(isset($errores) && in_array("AnhoInicioProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoInicioProy"])?$_POST["AnhoInicioProy"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AnhoFinProy">Año fin</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AnhoFinProy" name="AnhoFinProy" type="date" placeholder="Año fin" class="form-control <?php if(isset($errores) && in_array("AnhoFinProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoFinProy"])?$_POST["AnhoFinProy"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Importe">Importe</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="Importe" name="Importe" type="text" placeholder="Importe " class="form-control <?php if(isset($errores) && in_array("Importe", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Importe"])?$_POST["Importe"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TipoParticipacionProy">Tipo participación</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="TipoParticipacionProy" name="TipoParticipacionProy" type="text" placeholder="Tipo estancia" class="form-control <?php if(isset($errores) && in_array("TipoParticipacionProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoParticipacionProy"])?$_POST["TipoParticipacionProy"]:''?>">
                                    <option>--</option>
                                    <option <?php if(isset($_POST["TipoParticipacionProy"]) && $_POST["TipoParticipacionProy"] == "Investigador"){ echo "selected"; } ?>>Investigador</option>
                                    <option <?php if(isset($_POST["TipoParticipacionProy"]) && $_POST["TipoParticipacionProy"] == "Investigador Principal"){ echo "selected"; } ?>>Investigador Principal</option>
                                    </select></p>
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AdjuntoProy">Adjunto</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AdjuntoProy" name="AdjuntoProy" type="file[]"  class="form-control <?php if(isset($errores) && in_array("AdjuntoProy", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AdjuntoProy"])?$_POST["AdjuntoProy"]:''?>" multiple >
                        </div>
                    </div>

                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaProyecto" name="evento" value="altaProyecto" class="btn btn-orange">
                            Alta proyecto
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