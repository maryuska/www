<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';
$LoginU = $_SESSION["loginU"];
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
                <p class="lead separator separator-title">Lista de proyectos </p>

                <!--Tabs-nav opciones-->
                <div class="clearfix">
                    <!--Tabs-nav-->
                    <ul class="nav nav-tabs">
                        <li class="active "><a title="Proyectos mas recientes " href="#tab1" data-toggle="tab">Mas recientes</a></li>
                        <li ><a title="Como Investigador" href="#tab2" data-toggle="tab">Investigador</a></li>
                        <li ><a title="Como Investigador Principal" href="#tab3" data-toggle="tab">Investigador Pricipal</a></li>
                    </ul>
                </div>

                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Proyectos" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarProyecto" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Proyectos&evento=paginaInsertarProyectoAdmin">
                                Insertar proyecto
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>




                <div class="tab-content">
                    <!--listado de proyectos   -->
                    <div class="tab-pane fade in active" id="tab1">
                        <?php
                        $lista = $_SESSION["listarProyectosAdmin"];
                        $contador   = 0;
                        if (isset($lista)) {
                            foreach ($lista as $row){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- titulo proyecto -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "TituloPD" ><?php echo $row['TituloProy']; ?></td>
                                        </div>
                                        <!-- datos proyecto-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "CodigoProy" >Código proyecto:</b>
                                                    <?php echo $row['CodigoProy']; ?>
                                                    <br>
                                                    <b name = "EntidadFinanciadora">Entidad financiadora: </b>
                                                    <?php echo $row['EntidadFinanciadora']; ?>
                                                    <br>
                                                    <b  name = "AcronimoProy" >Acrónimo: </b>
                                                    <?php echo $row['AcronimoProy']; ?>
                                                    <br>
                                                    <b name = "AnhoInicioProy">Año inicio: </b>
                                                    <?php echo $row['AnhoInicioProy']; ?>
                                                    <br>
                                                    <b name = "AnhoFinProy">Año fin: </b>
                                                    <?php echo $row['AnhoFinProy']; ?>
                                                    <br>
                                                    <b name = "Importe">Importe: </b>
                                                    <?php echo $row['Importe']; ?>
                                                    <br>
                                                    <b name = "TipoParticipacionProy">Tipo participacion: </b>
                                                    <?php echo $row['TipoParticipacionProy']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarP<?php echo $contador; ?>" id="formBorrarP<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Proyectos">
                                                    <input type="hidden" name="evento" value="borrarProyecto">
                                                    <input type="hidden" name="CodigoProy" value="<?php echo $row['CodigoProy']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row['LoginU']; ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Proyectos&evento=consultarProyectoAdmin&CodigoProy=<?php echo $row['CodigoProy']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarP('formBorrarP<?php echo $contador; ?>', '<?php echo $row['CodigoProy']." ".$row['TituloProy']; ?>');">
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



                    <!--listado de TFC-->
                    <div class="tab-pane fade in" id="tab2">
                        <?php
                        $lista1 = $_SESSION["listarProyectosInvestigadorAdmin"];
                        $contador1   = 1;
                        if (isset($lista1)) {
                            foreach ($lista1 as $row1){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- titulo proyecto -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "TituloPD" ><?php echo $row1['TituloProy']; ?></td>
                                        </div>
                                        <!-- datos proyecto-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "CodigoProy" >Código proyecto:</b>
                                                    <?php echo $row1['CodigoProy']; ?>
                                                    <br>
                                                    <b name = "EntidadFinanciadora">Entidad financiadora: </b>
                                                    <?php echo $row1['EntidadFinanciadora']; ?>
                                                    <br>
                                                    <b  name = "AcronimoProy" >Acrónimo: </b>
                                                    <?php echo $row1['AcronimoProy']; ?>
                                                    <br>
                                                    <b name = "AnhoInicioProy">Año inicio: </b>
                                                    <?php echo $row1['AnhoInicioProy']; ?>
                                                    <br>
                                                    <b name = "AnhoFinProy">Año fin: </b>
                                                    <?php echo $row1['AnhoFinProy']; ?>
                                                    <br>
                                                    <b name = "Importe">Importe: </b>
                                                    <?php echo $row1['Importe']; ?>
                                                    <br>
                                                    <b name = "TipoParticipacionProy">Tipo participacion: </b>
                                                    <?php echo $row1['TipoParticipacionProy']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarP<?php echo $contador1; ?>" id="formBorrarP<?php echo $contador1; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Proyectos">
                                                    <input type="hidden" name="evento" value="borrarProyecto">
                                                    <input type="hidden" name="CodigoProy" value="<?php echo $row1['CodigoProy']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row1['LoginU']; ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Proyectos&evento=consultarProyectoAdmin&CodigoProy=<?php echo $row1['CodigoProy']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarP('formBorrarP<?php echo $contador1; ?>', '<?php echo $row1['CodigoProy']." ".$row1['TituloProy']; ?>');">
                                                        Borrar
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                $contador1++;
                            }
                        }
                        ?>

                    </div>

                    <!--listado de TFG -->
                    <div class="tab-pane fade " id="tab3">
                        <?php
                        $lista2 = $_SESSION["listarProyectosInvestigadorPrincipalAdmin"];
                        $contador2   = 1;
                        if (isset($lista2)) {
                            foreach ($lista2 as $row2){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- titulo proyecto -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "TituloPD" ><?php echo $row2['TituloProy']; ?></td>
                                        </div>
                                        <!-- datos proyecto-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "CodigoProy" >Código proyecto:</b>
                                                    <?php echo $row2['CodigoProy']; ?>
                                                    <br>
                                                    <b name = "EntidadFinanciadora">Entidad financiadora: </b>
                                                    <?php echo $row2['EntidadFinanciadora']; ?>
                                                    <br>
                                                    <b  name = "AcronimoProy" >Acrónimo: </b>
                                                    <?php echo $row2['AcronimoProy']; ?>
                                                    <br>
                                                    <b name = "AnhoInicioProy">Año inicio: </b>
                                                    <?php echo $row2['AnhoInicioProy']; ?>
                                                    <br>
                                                    <b name = "AnhoFinProy">Año fin: </b>
                                                    <?php echo $row2['AnhoFinProy']; ?>
                                                    <br>
                                                    <b name = "Importe">Importe: </b>
                                                    <?php echo $row2['Importe']; ?>
                                                    <br>
                                                    <b name = "TipoParticipacionProy">Tipo participacion: </b>
                                                    <?php echo $row2['TipoParticipacionProy']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarP<?php echo $contador2; ?>" id="formBorrarP<?php echo $contador2; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Proyectos">
                                                    <input type="hidden" name="evento" value="borrarProyecto">
                                                    <input type="hidden" name="CodigoProy" value="<?php echo $row2['CodigoProy']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row2['LoginU']; ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Proyectos&evento=consultarProyectoAdmin&CodigoProy=<?php echo $row2['CodigoProy']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarP('formBorrarP<?php echo $contador2; ?>', '<?php echo $row2['CodigoProy']." ".$row2['TituloProy']; ?>');">
                                                        Borrar
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                $contador2++;
                            }
                        }
                        ?>

                    </div>


                </div>
            </div>

            <!-- Confirmar borrar P -->
            <div id="confirmBorrarP" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-danger">
                            <h4 class="modal-title">Atención</h4>
                        </div>
                        <div class="modal-body text-center">
                            <h5>¿Desea eliminar el Proyecto  <strong class="nombre"></strong>?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                            <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN: Confirmar borrar P -->
            <?php
            // Pie y cierre de html, body
            require_once 'View/Structure/Footer.php';
            ?>
