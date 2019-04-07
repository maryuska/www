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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarTad()"  action="index.php?controlador=Tad" method="post">

                    <!-- Materia -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Tad</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoTAD">Código Tad</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoTAD" name="CodigoTAD" type="text" placeholder="Codigo Tad" class="form-control <?php if(isset($errores) && in_array("CodigoTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoTAD"])?$_POST["CodigoTAD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="LoginU">Login usuario</label>
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
                        <label class="col-md-4 col-lg-3 control-label" for="TituloTAD">Título Tad</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TituloTAD" name="TituloTAD" type="text" placeholder="Titulo" class="form-control <?php if(isset($errores) && in_array("TituloTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloTAD"])?$_POST["TituloTAD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AlumnoTAD">Alumno</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AlumnoTAD" name="AlumnoTAD" type="text" placeholder="Alumno" class="form-control <?php if(isset($errores) && in_array("AlumnoTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AlumnoTAD"])?$_POST["AlumnoTAD"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaLecturaTAD">Fecha lectura</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaLecturaTAD" name="FechaLecturaTAD" type="date" placeholder="Fecha lectura" class="form-control <?php if(isset($errores) && in_array("FechaLecturaTAD", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaLecturaTAD"])?$_POST["FechaLecturaTAD"]:''?>" >
                        </div>
                    </div>



                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaTad" name="evento" value="altaTadAdmin" class="btn btn-orange">
                            Alta Tad
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






