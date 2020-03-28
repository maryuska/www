
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
        <div class="col-md-offset-1 col-md-8 col-lg-offset-2 col-lg-6">
            <div class="cotainer">

                <?php
                // Si existe errores mostramos mensaje de error
                if(isset($errores)){
                    echo "<br>";
                    echo "<br>";
                    echo "<div class='row'>";
                    echo "  <div class='col-md-offset-4 col-md-8 col-lg-offset-3 col-lg-9'>";
                                require_once "View/errores.php";
                    echo "  </div>";
                    echo "</div>";
                }
                ?>

                <!-- Formulario -->

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="index.php?controlador=Pdf" method="post">

                    <input id="loginU" name="loginU" type="hidden" value="<?=$_SESSION["loginU"]?>">



                    <h2 class="text-center">¿Qué quieres ver en el pdf?</h2>

                    <br>

                    <div class="row">

                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="formacionAcademica" id="formacionAcademica" value="1">
                                    <label class="form-check-label" for="formacionAcademica">
                                        Formación académica
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-body">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="proyectosDirigidos" id="proyectosDirigidos" value="1">
                                    <label class="form-check-label" for="proyectosDirigidos">
                                        Proyectos Dirigidos
                                    </label>
                                </div>

                                <div class="col-xs-12">
                                    <label>Tipo</label>
                                    <select name="proyectosDirigidosTipo">
                                        <option value="">--</option>
                                        <option value="PFC">PFC</option>
                                        <option value="TFG">TFG</option>
                                        <option value="TFM">TFM</option>
                                    </select>
                                </div>

                                <div class="col-xs-12">
                                    <br>
                                    <label for="proyectosDirigidosDesde">Desde</label>
                                    <input type="date" id="proyectosDirigidosDesde" name="proyectosDirigidosDesde" autocomplete="off">
                                    <label for="proyectosDirigidosHasta">Hasta</label>
                                    <input type="date" id="proyectosDirigidosHasta" name="proyectosDirigidosHasta" autocomplete="off">



                                </div>











                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-body">                    
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="materias" id="materias" value="1">
                                    <label class="form-check-label" for="materias">
                                        Materias
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="congresos" id="congresos" value="1">
                                    <label class="form-check-label" for="congresos">
                                        Congresos
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="proyectos" id="proyectos" value="1">
                                    <label class="form-check-label" for="proyectos">
                                        Proyectos
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tad" id="tad" value="1">
                                    <label class="form-check-label" for="tad">
                                        Tad
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tesis" id="tesis" value="1">
                                    <label class="form-check-label" for="tesis">
                                        Tesis
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="text-center">
                            <br>
                            <button type="submit" name="evento" value="generar" class="btn btn-orange"> 
                                Generar
                            </button>
                        </div>
                    </div>

                    <br>
                    <br>

                </form>

            </div>
        </div>

    </div>
</div>

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
