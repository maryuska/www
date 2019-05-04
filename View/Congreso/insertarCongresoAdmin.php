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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarCongreso()"  action="index.php?controlador=Congresos" method="post">

                    <!-- congreso -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Congreso</h2>

                    <br>
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
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoC">Código Congreso</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoC" name="CodigoC" type="text" placeholder="Codigo congreso" class="form-control <?php if(isset($errores) && in_array("CodigoC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoC"])?$_POST["CodigoC"]:''?>" >
                            <input id="LoginU" name="LoginU" type="text" class="hidden" value="<?php echo $loginU; ?>"  >
                        </div>
                    </div>



                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="NombreC">Nombre congreso</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="NombreC" name="NombreC" type="text" placeholder="Nombre congreso" class="form-control <?php if(isset($errores) && in_array("NombreC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["NombreC"])?$_POST["NombreC"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AcronimoC">Acronimo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AcronimoC" name="AcronimoC" type="text" placeholder="Acronimo" class="form-control <?php if(isset($errores) && in_array("AcronimoC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AcronimoC"])?$_POST["AcronimoC"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AnhoC">Año</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AnhoC" name="AnhoC" type="date" placeholder="Año " class="form-control <?php if(isset($errores) && in_array("AnhoC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoC"])?$_POST["AnhoC"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="LugarC">Lugar</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="LugarC" name="LugarC" type="text" placeholder="Lugar " class="form-control <?php if(isset($errores) && in_array("LugarC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["LugarC"])?$_POST["LugarC"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TipoParticipacionC">Tipo Participación</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="TipoParticipacionC" name="TipoParticipacionC" type="text" placeholder="Tipo Participacion" class="form-control <?php if(isset($errores) && in_array("TipoParticipacionC", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoParticipacionC"])?$_POST["TipoParticipacionC"]:''?>">
                                    <option>--</option>
                                    <option>MCO</option>
                                    <option>MCC</option>
                                    <option>R</option>
                                    <option>C</option>
                                    <option>PCO</option>
                                    <option>PCC</option>
                                </select></p>
                        </div>
                    </div>


                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaCongreso" name="evento" value="altaCongreso" class="btn btn-orange">
                            Alta Congreso
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









