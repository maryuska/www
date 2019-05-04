
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
                <p class="lead separator separator-title">Lista de tesis</p>
                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Tesis" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarTesis" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Tesis&evento=paginaInsertarTesisAdmin">
                                Insertar Tesis
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>



                <div class="tab-content">


                    <?php
                    $lista = $_SESSION["listarTesisAdmin"];
                    $contador   = 1;
                    if (isset($lista)) {
                        foreach ($lista as $row){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- Nombre Tesis -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "CodigoTesis" ><?php echo $row['CodigoTesis']; ?></td>
                                    </div>
                                    <!-- datos tesis-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "AutorTesis" >Autor:</b>
                                                <?php echo $row['AutorTesis']; ?>
                                                <br>
                                                <b name = "LoginU" >Tutor:</b>
                                                <?php echo $row['LoginU']; ?>
                                                <br>
                                                <b name = "FechaInscripcion">Fecha inscripción: </b>
                                                <?php echo $row['FechaInscripcion']; ?>
                                                <br>
                                                <b  name = "FechaLectura" >Fecha Lectura: </b>
                                                <?php echo $row['FechaLectura']; ?>
                                                <br>
                                                <b name = "CalificacionTesis">Calificación: </b>
                                                <?php echo $row['CalificacionTesis']; ?>
                                                <br>
                                                <b  name = "URLTesis" >URL: </b>
                                                <?php echo $row['URLTesis']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarTesis<?php echo $contador; ?>" id="formBorrarTesis<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Tesis">
                                                <input type="hidden" name="evento" value="borrarTesis">
                                                <input type="hidden" name="CodigoTesis" value="<?php echo $row['CodigoTesis']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Tesis&evento=consultarTesis&CodigoTesis=<?php echo $row['CodigoTesis']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarTesis('formBorrarTesis<?php echo $contador; ?>', '<?php echo $row['CodigoTesis']." ".$row['AutorTesis']; ?>');">
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
<!-- Confirmar borrar tesis -->
<div id="confirmBorrarTesis" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar el Tesis de <strong class="nombre"></strong>?</h5>
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
