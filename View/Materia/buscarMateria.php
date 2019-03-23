
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

                                    <!-- Codigo materia -->
                                    <div class="panel-heading tdTitulo">
                                        <?php echo $row['CodigoM']; ?>
                                    </div>

                                    <!-- Datos Materia -->
                                    <div class="panel-body">

                                        <p class="margin-bottom5">
                                            <strong>Nombre:</strong>
                                            <span><?php echo $row['DenominacionM']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Login:</strong>
                                            <span><?php echo $row['LoginU']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Titulacion:</strong>
                                            <span><?php echo $row['TitulacionM']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Tipo:</strong>
                                            <span><?php echo $row['TipoM']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Tipo participación:</strong>
                                            <span><?php echo $row['TipoParticipacionM']; ?></span>
                                        </p>

                                        <p class="margin-bottom5">
                                            <strong>Créditos:</strong>
                                            <span><?php echo $row['CreditosM']; ?></span>
                                        </p>
                                        <p class="margin-bottom5">
                                            <strong>Cuatrimestre:</strong>
                                            <span><?php echo $row['CuatrimestreM']; ?></span>
                                        </p>
                                        <p class="margin-bottom5">
                                            <strong>Año académico:</strong>
                                            <span><?php echo $row['AnhoAcademicoM']; ?></span>
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