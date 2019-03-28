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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarEstancia()"  action="index.php?controlador=Estancias" method="post">

                    <!-- Estancia -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Estancia</h2>

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
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoE">Código estancia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoE" name="CodigoE" type="text" placeholder="Codigo estancia" class="form-control <?php if(isset($errores) && in_array("CodigoE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoE"])?$_POST["CodigoE"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CentroE">Centro de la estancia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CentroE" name="CentroE" type="text" placeholder="Centro estancia" class="form-control <?php if(isset($errores) && in_array("CentroE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CentroE"])?$_POST["CentroE"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="UniversidadE">Universidad de la estancia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="UniversidadE" name="UniversidadE" type="text" placeholder="Universidad estancia" class="form-control <?php if(isset($errores) && in_array("UniversidadE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["UniversidadE"])?$_POST["UniversidadE"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PaisE">Pais de la estancia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PaisE" name="PaisE" type="text" placeholder="Pais estancia" class="form-control <?php if(isset($errores) && in_array("PaisE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PaisE"])?$_POST["PaisE"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaInicioE">Fecha inicio de la estancia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaInicioE" name="FechaInicioE" type="date" placeholder="Fecha inicio" class="form-control <?php if(isset($errores) && in_array("FechaInicioE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaInicioE"])?$_POST["FechaInicioE"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaFinE">Fecha fin de la estancia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaFinE" name="FechaFinE" type="date" placeholder="Fecha fin" class="form-control <?php if(isset($errores) && in_array("FechaFinE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaFinE"])?$_POST["FechaFinE"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TipoE">Tipo estancia</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="TipoE" name="TipoE" type="text" placeholder="Tipo estancia" class="form-control <?php if(isset($errores) && in_array("TipoE", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoE"])?$_POST["TipoE"]:''?>">
                                    <option>--</option>
                                    <option >Investigacion</option>
                                    <option >Doctorado</option>
                                    <option>Invitado</option>
                                </select></p>
                        </div>
                    </div>

                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaEstancia" name="evento" value="altaEstanciaAdmin" class="btn btn-orange">
                            Alta estancia
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






