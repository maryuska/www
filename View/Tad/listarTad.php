
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
        <div class="col-md-10">
            <div class="cotainer">
           <!--Titulo de lo que se esta haciendo -->
            <p class="lead separator separator-title">Lista de TAD</p>
                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Tad" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarTad" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Tad&evento=paginaInsertarTad">
                                Insertar TAD
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>



            <div class="tab-content">


                    <?php
                    $lista = $_SESSION["listarTad"];
                    $contador   = 1;
                    if (isset($lista)) {
                    foreach ($lista as $row){ ?>

                    <div class="form-group col-lg-6">
                        <div class="panel panel-default">
                            <!-- Nombre TAD -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "TituloTAD" ><?php echo $row['TituloTAD']; ?></td>
                            </div>
                            <!-- datos proyecto-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b name = "CodigoTAD" >Código Tad:</b>
                                        <?php echo $row['CodigoTAD']; ?>
                                        <br>
                                        <b name = "AlumnoTAD">Alumno: </b>
                                        <?php echo $row['AlumnoTAD']; ?>
                                        <br>
                                        <b  name = "FechaLecturaTAD" >Fecha Lectura: </b>
                                        <?php echo $row['FechaLecturaTAD']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <div class="margin-bottom5 text-center">
                                    <form name="formBorrarTad<?php echo $contador; ?>" id="formBorrarTad<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                        <input type="hidden" name="controlador" value="Tad">
                                        <input type="hidden" name="evento" value="borrarTad">
                                        <input type="hidden" name="CodigoTAD" value="<?php echo $row['CodigoTAD']; ?>">
                                        <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Tad&evento=consultarTad&CodigoTAD=<?php echo $row['CodigoTAD']; ?>'">
                                            Modificar
                                        </button>
                                        <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarTad('formBorrarTAD<?php echo $contador; ?>', '<?php echo $row['TituloTAD']." ".$row['CodigoTAD']; ?>');">
                                            Borrar
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                   <?php
                        $contador++;
                        }
                    }
                   ?>


            </div>
        </div>

    </div>
</div>


</div>
<!-- Confirmar borrar tad -->
<div id="confirmBorrarTad" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar el TAD de <strong class="TituloTAD"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar tad -->
<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
