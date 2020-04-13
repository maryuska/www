
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
                    Lista busqueda Tesis
                </p>

                <!--listado de Tesis  -->
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

                                    <!-- Codigo tesis -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoTesis']; ?>
                                    </div>

                                    <!-- Datos tesis -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Autor:</strong>
                                            <span><?php echo $row['AutorTesis']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha Inscripción:</strong>
                                            <span><?php echo $row['FechaInscripcion']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha lectura:</strong>
                                            <span><?php echo $row['FechaLectura']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Calificación:</strong>
                                            <span><?php echo $row['CalificacionTesis']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>URL:</strong>
                                            <span><?php echo $row['URLTesis']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Adjunto:</strong>
                                            <span>
                                                <?php
                                                if(empty($row['AdjuntoT'])){
                                                    echo "No tiene.";
                                                }
                                                else{
                                                    echo "<a href='Archivos/tesis/{$row['AdjuntoT']}' target='_blank'>Ver adjunto</a>";
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