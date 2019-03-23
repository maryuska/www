
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
                $rows = $_SESSION["ConsultarU"];

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

                <form id="formulario" action="index.php?controlador=Usuarios" method="post">

                    <!-- Docente -->
                    
                    <h2 class="text-center">Modificar Perfil</h2>

                    <br>

                    <div class="form-group">
                        <label class="control-label" for="LoginU">Login: </label>
                        <input id="LoginU" name="LoginU"  class="form-control " value="<?php echo $row['LoginU']; ?>" disabled >
                        <input id="LoginU" name="LoginU" class="hidden" value="<?php echo $row['LoginU']; ?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="NombreU">Nombre:</label>
                        <input id="NombreU" name="NombreU" class="form-control <?php if(isset($errores) && in_array("NombreU", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["NombreU"])?$_POST["NombreU"]:$row['NombreU']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="ApellidosU">Apellidos:</label>
                        <input id="ApellidosU" name="ApellidosU" class="form-control <?php if(isset($errores) && in_array("ApellidosU", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["ApellidosU"])?$_POST["ApellidosU"]:$row['ApellidosU']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Telefono">Telefono:</label>
                        <input id="Telefono" name="Telefono" class="form-control <?php if(isset($errores) && in_array("Telefono", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Telefono"])?$_POST["Telefono"]:$row['Telefono']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Mail">Mail:</label>
                        <input id="Mail" name="Mail" class="form-control <?php if(isset($errores) && in_array("Mail", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Mail"])?$_POST["Mail"]:$row['Mail']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="DNI">DNI:</label>
                        <input id="DNI" name="DNI" class="form-control <?php if(isset($errores) && in_array("DNI", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["DNI"])?$_POST["DNI"]:$row['DNI']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="FechaNacimiento">Fecha Nacimiento:</label>
                        <input id="FechaNacimiento" type="date" name="FechaNacimiento" class="form-control <?php if(isset($errores) && in_array("FechaNacimiento", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaNacimiento"])?$_POST["FechaNacimiento"]:$row['FechaNacimiento']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="TipoContrato">Tipo Contrato:</label>
                        <input id="TipoContrato" name="TipoContrato" class="form-control <?php if(isset($errores) && in_array("TipoContrato", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoContrato"])?$_POST["TipoContrato"]:$row['TipoContrato']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Centro">Centro:</label>
                        <input id="Centro" name="Centro" class="form-control <?php if(isset($errores) && in_array("Centro", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Centro"])?$_POST["Centro"]:$row['Centro']?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Departamento">Departamento:</label>
                        <input id="Departamento" name="Departamento" class="form-control <?php if(isset($errores) && in_array("Departamento", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Departamento"])?$_POST["Departamento"]:$row['Departamento']?>" >
                    </div>

                    <br>

                    <div class="text-center">
                        <button type="submit" class="btn btn-orange" name="evento" value="modificarUsuario">
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

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>