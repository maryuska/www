
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
                    Lista busqueda Ponencia
                </p>

                <!--listado de ponencias-->
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

                                    <!-- Codigo ponencia-->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoP']; ?>
                                    </div>

                                    <!-- Datos TAD -->
                                    <div class="panel-body">

                                       <p class="margin-bottom5">
                                            <strong>Autores:</strong>
                                            <span><?php echo $row['AutoresP']; ?></span>
                                        </p>

					<p class="margin-bottom5">
                                            <strong>Título:</strong>
                                            <span><?php echo $row['TituloP']; ?></span>
                                        </p>

					<p class="margin-bottom5">
                                            <strong>Congreso:</strong>
                                            <span><?php echo $row['CongresoP']; ?></span>
                                        </p>

					<p class="margin-bottom5">
                                            <strong>Fecha inicio:</strong>
                                            <span><?php echo $row['FechaIniCP']; ?></span>
                                        </p>

					<p class="margin-bottom5">
                                            <strong>Fecha fin:</strong>
                                            <span><?php echo $row['FechaFinCP']; ?></span>
                                        </p>

					<p class="margin-bottom5">
                                            <strong>Lugar :</strong>
                                            <span><?php echo $row['LugarCP']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>País:</strong>
                                            <span><?php echo $row['PaisCP']; ?></span>
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