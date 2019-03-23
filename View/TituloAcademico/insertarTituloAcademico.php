
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

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarTituloAcademico()"  action="index.php?controlador=Usuarios" method="post">

                    <!-- Docente -->

                    <h2 class="col-md-offset-4 col-lg-offset-2 text-center">Insertar Título Académico</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-2 control-label" for="Titulo">Nombre Titulo</label>
                        <div class="col-md-8 col-lg-10">
                            <input id="Titulo" name="Titulo" type="text" placeholder="Nombre Titulo" class="form-control <?php if(isset($errores) && in_array("Titulo", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Titulo"])?$_POST["Titulo"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-2 control-label" for="FechaTitulo">Fecha Titulo</label>
                        <div class="col-md-8 col-lg-10">
                            <input id="FechaTitulo" name="FechaTitulo" type="date" placeholder="Fecha" class="form-control <?php if(isset($errores) && in_array("FechaTitulo", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaTitulo"])?$_POST["FechaTitulo"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 col-lg-2 control-label" for="CentroTitulo">Centro Titulo</label>
                        <div class="col-md-8 col-lg-10">
                            <input id="CentroTitulo" name="CentroTitulo" type="text" placeholder="Centro Titulo" class="form-control <?php if(isset($errores) && in_array("CentroTitulo", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CentroTitulo"])?$_POST["CentroTitulo"]:''?>" >
                        </div>
                    </div>

                    <div class="col-md-offset-4 col-lg-offset-2 text-center">
                        <input id="LoginU" name="LoginU" type="hidden" placeholder="LoginU" value="<?php echo $loginU ?>" >
                        <button type="submit" id="Registrar" name="evento" value="altaTituloAcademico" class="btn btn-orange">
                            Insertar
                        </button>
                    </div>

            </form>
        </div>
    </div>

</div>