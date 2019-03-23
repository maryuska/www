
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
                    echo "  <div class='col-md-offset-4 col-md-8 col-lg-offset-2 col-lg-10'>";
                                require_once "View/errores.php";
                    echo "  </div>";
                    echo "</div>";
                }
                ?>

                <!-- Formulario -->

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarUniversidad()"  action="index.php?controlador=Usuarios" method="post">

                    <!-- Docente -->

                    <h2 class="col-md-offset-4 col-lg-offset-2 text-center">Insertar Universidad</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-2 control-label" for="NombreUniversidad">Nombre</label>
                        <div class="col-md-8 col-lg-10">
                            <input id="NombreUniversidad" name="NombreUniversidad" type="text" placeholder="Nombre" class="form-control <?php if(isset($errores) && in_array("NombreUniversidad", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["NombreUniversidad"])?$_POST["NombreUniversidad"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-2 control-label" for="FechaInicio">Fecha Inicio</label>
                        <div class="col-md-8 col-lg-10">
                            <input id="FechaInicio" name="FechaInicio" type="date" placeholder="Fecha Inicio" class="form-control <?php if(isset($errores) && in_array("FechaInicio", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaInicio"])?$_POST["FechaInicio"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 col-lg-2 control-label" for="FechaFin">Fecha Fin</label>
                        <div class="col-md-8 col-lg-10">
                            <input id="FechaFin" name="FechaFin" type="date" placeholder="Fecha Fin" class="form-control <?php if(isset($errores) && in_array("FechaFin", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaFin"])?$_POST["FechaFin"]:''?>" >
                        </div>
                    </div>

                    <div class="col-md-offset-4 col-lg-offset-2 text-center">
                        <input id="LoginU" name="LoginU" type="hidden" placeholder="LoginU" value="<?php echo $loginU ?>" >
                        <button type="submit" id="Registrar" name="evento" value="altaUniversidad" class="btn btn-orange">
                            Insertar
                        </button>
                    </div>

            </form>
        </div>
    </div>

</div>