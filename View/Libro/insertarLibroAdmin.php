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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarLibro()"  action="index.php?controlador=Libros" method="post">

                    <!-- Libro -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Libro</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Login">Login usuario</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="Login" name="Login" type="text" placeholder="Login usuario" class="form-control <?php if(isset($errores) && in_array("Login", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Login"])?$_POST["Login"]:''?>">
                                    <option>--</option>
                                    <?php $rows = $_SESSION["listarUsuarios"]; foreach ($rows as $row){ ?>
                                        <option value="<?php echo $row['LoginU'];?>"><?php echo $row['LoginU']." - ".$row['NombreU'];?></option>
                                    <?php } ?>
                                </select></p>
                        </div>
                    </div>
                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoE">Código libro</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoL" name="CodigoL" type="text" placeholder="Codigo libro" class="form-control <?php if(isset($errores) && in_array("CodigoL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoL"])?$_POST["CodigoL"]:''?>" >
                            <input id="LoginU" name="LoginU" type="text" class="hidden" value="<?php echo $loginU; ?>"  >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AutoresL">Autores del libro</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AutoresL" name="AutoresL" type="text" placeholder=" Autores libro" class="form-control <?php if(isset($errores) && in_array("AutoresL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AutoresL"])?$_POST["AutoresL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TituloL">Titulo del libro</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TituloL" name="TituloL" type="text" placeholder="Titulo libro" class="form-control <?php if(isset($errores) && in_array("TituloL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloL"])?$_POST["TituloL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="ISBN">ISBN</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="ISBN" name="ISBN" type="text" placeholder="ISBN" class="form-control <?php if(isset($errores) && in_array("ISBN", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["ISBN"])?$_POST["ISBN"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PagIniL">Página de inicio</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PagIniL" name="PagIniL" type="text" placeholder="Pagina inicio" class="form-control <?php if(isset($errores) && in_array("PagIniL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PagIniL"])?$_POST["PagIniL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PagFinL">Página de fin</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PagFinL" name="PagFinL" type="text" placeholder="Pagina fin" class="form-control <?php if(isset($errores) && in_array("PagFinL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PagFinL"])?$_POST["PagFinL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="VolumenL">Volumen</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="VolumenL" name="VolumenL" type="text" placeholder="Volumen" class="form-control <?php if(isset($errores) && in_array("VolumenL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["VolumenL"])?$_POST["VolumenL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="EditorialL">Editorial</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="EditorialL" name="EditorialL" type="text" placeholder="Editorial" class="form-control <?php if(isset($errores) && in_array("EditorialL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["EditorialL"])?$_POST["EditorialL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaPublicacionL">Fecha publicación</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaPublicacionL" name="FechaPublicacionL" type="date" placeholder="Fecha publicacion" class="form-control <?php if(isset($errores) && in_array("FechaPublicacionL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaPublicacionL"])?$_POST["FechaPublicacionL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="EditorL">Editor</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="EditorL" name="EditorL" type="text" placeholder="Editor" class="form-control <?php if(isset($errores) && in_array("EditorL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["EditorL"])?$_POST["EditorL"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PaisEdicionL">País de edición</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PaisEdicionL" name="PaisEdicionL" type="text" placeholder="País edición" class="form-control <?php if(isset($errores) && in_array("PaisEdicionL", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PaisEdicionL"])?$_POST["PaisEdicionL"]:''?>" >
                        </div>
                    </div>


                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaLibro" name="evento" value="altaLibroAdmin" class="btn btn-orange">
                            Alta libro
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






