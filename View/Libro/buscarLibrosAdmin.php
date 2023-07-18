
<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';

$usuario = $_SESSION["listarBusqueda"];

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
                    Lista Materias
                </p>

                <!--listado de libros  -->
                <div class="row">

                    <?php
                    $lista = $_SESSION["listarBusqueda"];
                    $contador   = 1;
                    if (isset($lista)) {
                        foreach ($lista as $row){
                            ?>

                            <div class="col-md-6 col-lg-4">

                                <!-- Box -->

                                <div class="panel panel-default">

                                    <!-- Codigo Libro -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoL']; ?>
                                    </div>

                                    <!-- Datos libro -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Autores:</strong>
                                            <span><?php echo $row['AutoresL']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Título:</strong>
                                            <span><?php echo $row['TituloL']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>ISBN:</strong>
                                            <span><?php echo $row['ISBN']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Página inicio:</strong>
                                            <span><?php echo $row['PafIniL']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Página fin:</strong>
                                            <span><?php echo $row['PagFinL']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Volumen:</strong>
                                            <span><?php echo $row['Volumen']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Editorial:</strong>
                                            <span><?php echo $row['EditorialL']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha Publicación:</strong>
                                            <span><?php echo $row['FechaPublicacionL']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Editor:</strong>
                                            <span><?php echo $row['EditorL']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Pais edición:</strong>
                                            <span><?php echo $row['PaisEdicionL']; ?></span>
                                        </p>


                                    </div>

                                    <div class="margin-bottom5 text-center">
                                        <form name="formBorrarLibro<?php echo $contador; ?>" id="formBorrarLibro<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                            <input type="hidden" name="controlador" value="Libros">
                                            <input type="hidden" name="evento" value="borrarLibro">
                                            <input type="hidden" name="LoginU" value="<?php echo $row['CodigoL']; ?>">
                                            <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarLibro('formBorrarLibro<?php echo $contador; ?>', '<?php echo $row['CodigoL']." ".$row['ISBN']; ?>');">
                                                Borrar
                                            </button>
                                        </form>
                                    </div>



                                </div>

                            </div>

                            <?php
                        }
                    }
                    $contador++;
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
