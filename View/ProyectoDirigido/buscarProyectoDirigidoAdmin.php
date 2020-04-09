
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
<!--
                <div class="col-lg-6 col-md-3 col-xs-2">
                    <a class="btn btn-orange " href="index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos">
                        Volver atras
                    </a>
                </div>
-->
                <!-- Título -->
                <p class="lead separator separator-title">
                    Busqueda de proyectos dirigidos
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

                                    <!-- Codigo Proyecto dirigido -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoPD']; ?>
                                    </div>

                                    <!-- Datos Proyecto dirigido -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Título:</strong>
                                            <span><?php echo $row['TituloPD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Alumno:</strong>
                                            <span><?php echo $row['AlumnoPD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha lectura:</strong>
                                            <span><?php echo $row['FechaLecturaPD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Calificación:</strong>
                                            <span><?php echo $row['CalificacionPD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>URL:</strong>
                                            <span><?php echo $row['URLPD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Cotutor:</strong>
                                            <span><?php echo $row['CotutorPD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Tipo:</strong>
                                            <span><?php echo $row['TipoPD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Adjunto:</strong>
                                            <span>
                                                <?php 
                                                    if(empty($row['AdjuntoPD'])){
                                                        echo "No tiene.";
                                                    }
                                                    else{
                                                        echo "<a href='Archivos/proyectos_dirigidos/{$row['AdjuntoPD']}' target='_blank'>Ver adjunto</a>";
                                                    }
                                                ?>
                                            </span>
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