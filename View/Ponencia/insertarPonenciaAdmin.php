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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarPonencia()"  action="index.php?controlador=Tad" method="post">

                    <!-- Ponencia-->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Tad</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoP">Código Ponencia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoP" name="CodigoP" type="text" placeholder="Codigo Ponencia" class="form-control <?php if(isset($errores) && in_array("CodigoP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoP"])?$_POST["CodigoP"]:''?>" >
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
           		 <label class="col-md-4 col-lg-3 control-label" for="TituloP">Título Ponencia</label>
           		 <div class="col-md-8 col-lg-9">
              			<input id="TituloP" name="TituloP" type="text" placeholder="Título" class="form-control <?php if(isset($errores) && in_array("TituloP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloP"])?$_POST["TituloP"]:''?>" >
            		 </div>
      		  </div>

        	  <div class="form-group form-group-md">
            		<label class="col-md-4 col-lg-3 control-label" for="CongresoP">Congreso</label>
            		<div class="col-md-8 col-lg-9">
                		<input id="CongresoP" name="CongresoP" type="text" placeholder="Congreso" class="form-control <?php if(isset($errores) && in_array("CongresoP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CongresoP"])?$_POST["CongresoP"]:''?>" >
            		</div>
        	  </div>

        	<div class="form-group form-group-md">
            		<label class="col-md-4 col-lg-3 control-label" for="FechaIniCP">Fecha inicio</label>
            		<div class="col-md-8 col-lg-9">
                		<input id="FechaIniCP" name="FechaIniCP" type="date" placeholder="Fecha inicio" class="form-control <?php if(isset($errores) && in_array("FechaIniCP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaIniCP"])?$_POST["FechaIniCP"]:''?>" >
            		</div>
        	</div>


        	<div class="form-group form-group-md">
            		<label class="col-md-4 col-lg-3 control-label" for="FechaFinCP">Fecha fin</label>
            		<div class="col-md-8 col-lg-9">
                		<input id="FechaFinCP" name="FechaFinCP" type="date" placeholder="Fecha fin" class="form-control <?php if(isset($errores) && in_array("FechaFinCP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaFinCP"])?$_POST["FechaFinCP"]:''?>" >
            		</div>
        	</div>

        	<div class="form-group form-group-md">
            		<label class="col-md-4 col-lg-3 control-label" for="LugarCP">Lugar</label>
            		<div class="col-md-8 col-lg-9">
                		<input id="LugarCP" name="LugarCP" type="text" placeholder="Lugar" class="form-control <?php if(isset($errores) && in_array("LugarCP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["LugarCP"])?$_POST["LugarCP"]:''?>" >
            		</div>
        	</div>

        	<div class="form-group form-group-md">
            		<label class="col-md-4 col-lg-3 control-label" for="PaisCP">País</label>
            		<div class="col-md-8 col-lg-9">
                		<input id="PaisCP" name="PaisCP" type="text" placeholder="País" class="form-control <?php if(isset($errores) && in_array("PaisCP", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PaisCP"])?$_POST["PaisCP"]:''?>" >
            	</div>
        	</div>


                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaPonencia" name="evento" value="altaPonenciaAdmin" class="btn btn-orange">
                            Alta Ponencia
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
// Eliminamos el listado de usuarios cargado en session
unset($_SESSION["listarUsuarios"]);
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>