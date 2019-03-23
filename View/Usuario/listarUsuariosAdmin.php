
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
        <div class="col-md-10">
            <div class="cotainer">
            
                <!-- Título -->
                <p class="lead separator separator-title">
                    Lista Usuarios
                </p>

                <!-- Botón buscar -->
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Usuarios" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-8">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarUsuario" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Usuarios&evento=paginaAltaUsuarioAdmin">
                                Insertar usuario
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>

                <!--listado de proyectos dirigidos  -->
                <div class="row">
                    
                    <?php
                    $lista      = $_SESSION["listarUsuarios"];
                    $contador   = 1;
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

                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarPerfil<?php echo $contador; ?>" id="formBorrarPerfil<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Usuarios">
                                                <input type="hidden" name="evento" value="borrarUsuario">
                                                <input type="hidden" name="LoginU" value="<?php echo $row['LoginU']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Usuarios&evento=consultarDetalleUsuario&LoginU=<?php echo $row['LoginU']; ?>'">
                                                    Consultar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarPerfil('formBorrarPerfil<?php echo $contador; ?>', '<?php echo $row['NombreU']." ".$row['ApellidosU']; ?>');">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                                            
                            </div>

                    <?php 

                            $contador++;

                        } 
                    } 
                    ?>

                </div>

            </div>
        </div>

    </div>
</div>

<!-- Confirmar borrar perfil -->
<div id="confirmBorrarPerfil" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar el perfil de <strong class="nombre"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>                    
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar perfil -->

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>