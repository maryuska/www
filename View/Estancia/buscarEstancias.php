
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
                    Lista estancias
                </p>

                <!--listado de estancias  -->
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

                                    <!-- Codigo estancia -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoE']; ?>
                                    </div>

                                    <!-- Datos estancia -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Centro:</strong>
                                            <span><?php echo $row['CentroE']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Universidad:</strong>
                                            <span><?php echo $row['UniversidadE']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Pais:</strong>
                                            <span><?php echo $row['PaisE']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha inicio:</strong>
                                            <span><?php echo $row['FechaInicioE']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha fin:</strong>
                                            <span><?php echo $row['FechaFinE']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Tipo:</strong>
                                            <span><?php echo $row['TipoE']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Adjunto:</strong>
                                            <span>
                                                <?php
                                                if(empty($row['AdjuntoE'])){
                                                    echo "No tiene.";
                                                }
                                                else{
                                                    echo "<a href='Archivos/estancias/{$row['AdjuntoE']}' target='_blank'>Ver adjunto</a>";
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