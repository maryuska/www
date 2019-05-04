
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
                    Lista Congresos
                </p>

                <!--listado de congresos  -->
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

                                    <!-- Codigo congresos -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoC']; ?>
                                    </div>

                                    <!-- Datos congreso -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Nombre:</strong>
                                            <span><?php echo $row['NombreC']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Acronimo:</strong>
                                            <span><?php echo $row['AcronimoC']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Año:</strong>
                                            <span><?php echo $row['AnhoC']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Lugar:</strong>
                                            <span><?php echo $row['LugarC']; ?></span>
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