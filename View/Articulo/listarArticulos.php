
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
                    Lista Artículos
                </p>

                <!-- Botón buscar -->
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Articulos" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-8">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar" value="<?php if(isset($TituloBusqueda)){ echo $TituloBusqueda; } ?>">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarArticulo" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Articulos&evento=paginaAltaArticulo">
                                Insertar artículo
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>

                <!--listado -->
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

                                    <!-- Título -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['TituloA']; ?>
                                    </div>

                                    <!-- Datos usuario -->
                                    <div class="panel-body">
                                        
                                        <p class="margin-bottom5">
                                            <strong>Código:</strong>
                                            <span><?php echo $row['CodigoA']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Titulo Revista:</strong>
                                            <span><?php echo $row['TituloR']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>ISSN:</strong>
                                            <span><?php echo $row['ISSN']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Volumen Revista:</strong>
                                            <span><?php echo $row['VolumenR']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>PagIniA:</strong>
                                            <span><?php echo $row['PagIniA']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>PagFinA:</strong>
                                            <span><?php echo $row['PagFinA']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha Publicación Revista:</strong>
                                            <span><?php echo $row['FechaPublicacionR']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Estado:</strong>
                                            <span><?php echo $row['EstadoA']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Autores:</strong>
                                            <span>
                                            <?php
                                                $consulta = $articulo->ConsultarAutores($row['CodigoA']);
                                                if(mysqli_num_rows($consulta) > 0){
                                                    while($rowAutor = mysqli_fetch_array($consulta)){
                                                        echo $rowAutor['NombreAutor'];
                                                    }
                                                }
                                            ?>
                                            </span>
                                        </p>

                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarArticulo<?php echo $contador; ?>" id="formBorrarArticulo<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Articulos">
                                                <input type="hidden" name="evento" value="borrarArticulo">
                                                <input type="hidden" name="CodigoA" value="<?php echo $row['CodigoA']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Articulos&evento=paginaEditarArticulo&CodigoA=<?php echo $row['CodigoA']; ?>'">
                                                    Editar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarArticulo('formBorrarArticulo<?php echo $contador; ?>', '<?php echo $row['TituloA']; ?>');">
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

                    unset($_SESSION["listarUsuarios"]); // Eliminamos la búsqueda o listado
                    ?>

                </div>

            </div>
        </div>

    </div>
</div>

<!-- Confirmar borrar articulo -->
<div id="confirmBorrarArticulo" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar el artículo <strong class="nombre"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>                    
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar articulo -->

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>