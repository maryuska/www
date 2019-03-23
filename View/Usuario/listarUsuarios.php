
<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';

$usuario = $_SESSION["listarUsuarios"];

?>

<div class="container-fluid">
    <div class="row">

        <?php
        // Menu lateral
        require_once 'View/Structure/Sidebar.php';
        ?>

        <!-- Contenido -->
        <div class="col-md-10">
            <div class="cotainer">
            
                <!-- Título -->
                <p class="lead separator separator-title">
                    Lista Usuarios
                </p>

                <!-- Botón buscar -->
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Usuarios" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarUsuario" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>

                <br>
                <br>

                <!--listado de usuarios  -->
                <div class="row">
                    
                    <?php
                    $lista = $_SESSION["listarUsuarios"];
                    if (isset($lista)) {
                        foreach ($lista as $row){ 
                    ?>

                            <div class="col-md-6 col-lg-4">

                                <!-- Box -->

                                <div class="panel panel-default">

                                    <!-- Login usuario -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['LoginU']; ?>
                                    </div>

                                    <!-- Datos usuario -->
                                    <div class="panel-body">
                                        
                                        <p class="margin-bottom5">
                                            <strong>Nombre:</strong>
                                            <span><?php echo $row['NombreU']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Apellidos:</strong>
                                            <span><?php echo $row['ApellidosU']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Centro:</strong>
                                            <span><?php echo $row['Centro']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Departamento:</strong>
                                            <span><?php echo $row['Departamento']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Mail:</strong>
                                            <span><?php echo $row['Mail']; ?></span>
                                        </p>

                                        <p class="margin-bottom5 text-center">
                                            <a class="btn btn-orange" href="index.php?controlador=Usuarios&evento=consultarDetalleUsuario&LoginU=<?php echo $row['LoginU']; ?>">
                                                Consultar
                                            </a>
                                        </p>

                                    </div>

                                </div>
                                            
                            </div>

                    <?php 
                        } 
                    } 
                    ?>

                </div>

            </div>
        </div>

    </div>
</div>
            

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>