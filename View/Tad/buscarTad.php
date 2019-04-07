
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
                    Lista busqueda TAD
                </p>

                <!--listado de Tad  -->
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

                                    <!-- Codigo TAD -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoTAD']; ?>
                                    </div>

                                    <!-- Datos TAD -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Título:</strong>
                                            <span><?php echo $row['TituloTAD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Alumno:</strong>
                                            <span><?php echo $row['AlumnoTAD']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Fecha lectura:</strong>
                                            <span><?php echo $row['FechaLecturaTAD']; ?></span>
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