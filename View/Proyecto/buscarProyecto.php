
<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';

$usuario = $_SESSION["listarBusqueda"];
$LoginU = $_SESSION["loginU"];
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
<!--
                <div class="col-lg-6 col-md-3 col-xs-2">
                    <a class="btn btn-orange " href="index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=$LoginU">
                        Volver atras
                    </a>
                </div>
                -->

                <!-- Título -->
                <p class="lead separator separator-title">
                    Busqueda de proyectos
                </p>

                <!--listado de materias  -->
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

                                    <!-- Codigo Proyecto  -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoProy']; ?>
                                    </div>

                                    <!-- Datos Proyecto  -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Título:</strong>
                                            <span><?php echo $row['TituloProy']; ?></span>
                                        </p>
                                        <p class="margin-bottom5">
                                            <strong>Docente:</strong>
                                            <span><?php echo $row['LoginU']; ?></span>
                                        </p>
                                        <p class="margin-bottom5">
                                            <strong>Entidad Financiadora:</strong>
                                            <span><?php echo $row['EntidadFinanciadora']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Acronimo:</strong>
                                            <span><?php echo $row['AcronimoProy']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Año inicio:</strong>
                                            <span><?php echo $row['AnhoInicioProy']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Año fin:</strong>
                                            <span><?php echo $row['AnhoFinProyecto']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Importe:</strong>
                                            <span><?php echo $row['Importe']; ?></span>
                                        </p>
                                        <p class="margin-bottom5">
                                            <strong>Tipo participacion:</strong>
                                            <span><?php echo $row['TipoParticipacionProy']; ?></span>
                                        </p>



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