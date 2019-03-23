
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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarUsuario()"  action="index.php?controlador=Usuarios" method="post">

                    <!-- Docente -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Alta Usuario</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Login">Login Usuario</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="Login" name="Login" type="text" placeholder="Login Usuario" class="form-control <?php if(isset($errores) && in_array("Login", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Login"])?$_POST["Login"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PasswordU">Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PasswordU" name="PasswordU" type="password" placeholder="Password" class="form-control <?php if(isset($errores) && in_array("PasswordU", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PasswordU"])?$_POST["PasswordU"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PasswordU2">Repetir Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PasswordU2" name="PasswordU2" type="password" placeholder="Repetir Password" class="form-control <?php if(isset($errores) && in_array("PasswordU2", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PasswordU2"])?$_POST["PasswordU2"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="NombreU">Nombre Usuario</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="NombreU" name="NombreU" type="text" placeholder="Nombre Usuario" class="form-control <?php if(isset($errores) && in_array("NombreU", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["NombreU"])?$_POST["NombreU"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="ApellidosU">Apellidos</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="ApellidosU" name="ApellidosU" type="text" placeholder="Apellidos" class="form-control <?php if(isset($errores) && in_array("ApellidosU", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["ApellidosU"])?$_POST["ApellidosU"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Telefono">Telefono</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="Telefono" name="Telefono" type="text" placeholder="Telefono" class="form-control <?php if(isset($errores) && in_array("Telefono", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Telefono"])?$_POST["Telefono"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Mail">Mail</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="Mail" name="Mail" type="text" placeholder="Mail" class="form-control <?php if(isset($errores) && in_array("Mail", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Mail"])?$_POST["Mail"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="DNI">DNI</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="DNI" name="DNI" type="text" placeholder="DNI" class="form-control <?php if(isset($errores) && in_array("DNI", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["DNI"])?$_POST["DNI"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaNacimiento">Fecha Nacimiento</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaNacimiento" name="FechaNacimiento" type="date" placeholder="Fecha Nacimiento" class="form-control <?php if(isset($errores) && in_array("FechaNacimiento", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaNacimiento"])?$_POST["FechaNacimiento"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TipoContrato">Tipo Contrato</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TipoContrato" name="TipoContrato" type="text" placeholder="Tipo Contrato" class="form-control <?php if(isset($errores) && in_array("TipoContrato", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoContrato"])?$_POST["TipoContrato"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Centro">Centro de trabajo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="Centro" name="Centro" type="text" placeholder="Centro de trabajo" class="form-control <?php if(isset($errores) && in_array("Centro", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Centro"])?$_POST["Centro"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Departamento">Departamento</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="Departamento" name="Departamento" type="text" placeholder="Departamento" class="form-control <?php if(isset($errores) && in_array("Departamento", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Departamento"])?$_POST["Departamento"]:''?>" >
                        </div>
                    </div>


                    <!-- Universidad -->

                    <h3 class="col-md-offset-4 col-lg-offset-3 text-center">Datos de la Universidad</h3>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="NombreUniversidad">Nombre</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="NombreUniversidad" name="NombreUniversidad" type="text" placeholder="Nombre" class="form-control <?php if(isset($errores) && in_array("NombreUniversidad", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["NombreUniversidad"])?$_POST["NombreUniversidad"]:''?>" >
                        </div>
                    </div>
                    
                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaInicio">Fecha Inicio</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaInicio" name="FechaInicio" type="date" placeholder="Fecha Inicio" class="form-control <?php if(isset($errores) && in_array("FechaInicio", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaInicio"])?$_POST["FechaInicio"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaFin">Fecha Fin</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaFin" name="FechaFin" type="date" placeholder="Fecha Fin" class="form-control <?php if(isset($errores) && in_array("FechaFin", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaFin"])?$_POST["FechaFin"]:''?>" >
                        </div>
                    </div>

                    <!-- Título -->
                    <h3 class="col-md-offset-4 col-lg-offset-3 text-center">Datos del Titulo</h3>
                    
                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Titulo">Nombre Titulo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="Titulo" name="Titulo" type="text" placeholder="Nombre Titulo" class="form-control <?php if(isset($errores) && in_array("Titulo", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Titulo"])?$_POST["Titulo"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaTitulo">Fecha Titulo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaTitulo" name="FechaTitulo" type="date" placeholder="Fecha" class="form-control <?php if(isset($errores) && in_array("FechaTitulo", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaTitulo"])?$_POST["FechaTitulo"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CentroTitulo">Centro Titulo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CentroTitulo" name="CentroTitulo" type="text" placeholder="Centro Titulo" class="form-control <?php if(isset($errores) && in_array("CentroTitulo", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CentroTitulo"])?$_POST["CentroTitulo"]:''?>" >
                        </div>
                    </div>

                    <br>

                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="Registrar" name="evento" value="altaUsuario" class="btn btn-orange"> 
                            Alta usuario
                        </button>
                    </div>

                    <br>
                    <br>

                </form>

            </div>
        </div>
        
    </div>
</div>

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>