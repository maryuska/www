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
                <p class="lead separator separator-title">Lista de proyectos dirigidos</p>

                <!--Tabs-nav opciones-->
                <div class="clearfix">
                    <!--Tabs-nav-->
                    <ul class="nav nav-tabs">
                        <li class="active "><a title="Proyectos dirigidos mas recientes " href="#tab1" data-toggle="tab">Mas recientes</a></li>
                        <li ><a title="Proyectos fin de carrera" href="#tab2" data-toggle="tab">PFC</a></li>
                        <li ><a title="Trabajo fin de grado" href="#tab3" data-toggle="tab">TFG</a></li>
                        <li ><a title="Trabajo fin de Master" href="#tab4" data-toggle="tab">TFM</a></li>

                    </ul>

                </div>

                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=ProyectosDirigidos" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarProyectoDirigido" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=ProyectosDirigidos&evento=paginaInsertarProyectoDirigidoAdmin">
                                Insertar proyecto
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>




                <div class="tab-content">
                    <!--listado de proyectos dirigidos  -->
                    <div class="tab-pane fade in active" id="tab1">
                        <?php
                        $lista = $_SESSION["listarProyectosDirigidosAdmin"];
                        $contador   = 1;
                        if (isset($lista)) {
                            foreach ($lista as $row){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- titulo proyecto -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "TituloPD" ><?php echo $row['TituloPD']; ?></td>
                                        </div>
                                        <!-- datos proyecto-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "CodigoPD" >Código proyecto:</b>
                                                    <?php echo $row['CodigoPD']; ?>
                                                    <br>
                                                    <b name = "LoginU" >Tutor:</b>
                                                    <?php echo $row['LoginU']; ?>
                                                    <br>
                                                    <b name = "AlumnoPD">Alumno: </b>
                                                    <?php echo $row['AlumnoPD']; ?>
                                                    <br>
                                                    <b  name = "FechaLecturaPD" >Fecha lectura: </b>
                                                    <?php echo $row['FechaLecturaPD']; ?>
                                                    <br>
                                                    <b name = "CalificacionPD">Calificacion: </b>
                                                    <?php echo $row['CalificacionPD']; ?>
                                                    <br>
                                                    <b name = "URLPD">URL: </b>
                                                    <?php echo $row['URLPD']; ?>
                                                    <br>
                                                    <b name = "CotutorPD">Cotutor: </b>
                                                    <?php echo $row['CotutorPD']; ?>
                                                    <br>
                                                    <b name = "TipoPD">Tipo proyecto: </b>
                                                    <?php echo $row['TipoPD']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarPD<?php echo $contador; ?>" id="formBorrarPD<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="ProyectosDirigidos">
                                                    <input type="hidden" name="evento" value="borrarProyectoDirigido">
                                                    <input type="hidden" name="CodigoPD" value="<?php echo $row['CodigoPD']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row['LoginU'] ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=ProyectosDirigidos&evento=consultarProyectoDirigido&CodigoPD=<?php echo $row['CodigoPD']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmPD('formBorrarPD<?php echo $contador; ?>', '<?php echo $row['TituloPD']." ".$row['CodigoPD']; ?>');">
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
                        $lista1 = $_SESSION["listarProyectosDirigidosTFCAdmin"];
                        $contador1   = 1;
                        if (isset($lista1)) {
                            foreach ($lista1 as $row1){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- titulo proyecto -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "TituloPD" ><?php echo $row1['TituloPD']; ?></td>
                                        </div>
                                        <!-- datos proyecto-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "CodigoPD" >Código proyecto:</b>
                                                    <?php echo $row1['CodigoPD']; ?>
                                                    <br>
                                                    <b name = "LoginU" >Tutor:</b>
                                                    <?php echo $row1['LoginU']; ?>
                                                    <br>
                                                    <b name = "AlumnoPD">Alumno: </b>
                                                    <?php echo $row1['AlumnoPD']; ?>
                                                    <br>
                                                    <b  name = "FechaLecturaPD" >Fecha lectura: </b>
                                                    <?php echo $row1['FechaLecturaPD']; ?>
                                                    <br>
                                                    <b name = "CalificacionPD">Calificacion: </b>
                                                    <?php echo $row1['CalificacionPD']; ?>
                                                    <br>
                                                    <b name = "URLPD">URL: </b>
                                                    <?php echo $row1['URLPD']; ?>
                                                    <br>
                                                    <b name = "CotutorPD">Cotutor: </b>
                                                    <?php echo $row1['CotutorPD']; ?>
                                                    <br>
                                                    <b name = "TipoPD">Tipo proyecto: </b>
                                                    <?php echo $row1['TipoPD']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarPD<?php echo $contador1; ?>" id="formBorrarPD<?php echo $contador1; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="ProyectosDirigidos">
                                                    <input type="hidden" name="evento" value="borrarProyectoDirigido">
                                                    <input type="hidden" name="CodigoPD" value="<?php echo $row1['CodigoPD']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row1['LoginU'] ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=ProyectosDirigidos&evento=consultarProyectoDirigido&CodigoPD=<?php echo $row1['CodigoPD']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmPD('formBorrarPD<?php echo $contador1; ?>', '<?php echo $row1['TituloPD']." ".$row1['CodigoPD']; ?>');">
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
                    <div class="tab-pane fade in" id="tab3">
                        <?php
                        $lista2 = $_SESSION["listarProyectosDirigidosTFGAdmin"];
                        $contador2   = 1;
                        if (isset($lista2)) {
                            foreach ($lista2 as $row2){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- titulo proyecto -->
                                        <div class="tdTitulo">
                                            <td type="submit" name = "TituloPD" ><?php echo $row2['TituloPD']; ?></td>
                                        </div>
                                        <!-- datos proyecto-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "CodigoPD" >Código proyecto:</b>
                                                    <?php echo $row2['CodigoPD']; ?>
                                                    <br>
                                                    <b name = "LoginU" >Tutor:</b>
                                                    <?php echo $row2['LoginU']; ?>
                                                    <br>
                                                    <b name = "AlumnoPD">Alumno: </b>
                                                    <?php echo $row2['AlumnoPD']; ?>
                                                    <br>
                                                    <b  name = "FechaLecturaPD" >Fecha lectura: </b>
                                                    <?php echo $row2['FechaLecturaPD']; ?>
                                                    <br>
                                                    <b name = "CalificacionPD">Calificacion: </b>
                                                    <?php echo $row2['CalificacionPD']; ?>
                                                    <br>
                                                    <b name = "URLPD">URL: </b>
                                                    <?php echo $row2['URLPD']; ?>
                                                    <br>
                                                    <b name = "CotutorPD">Cotutor: </b>
                                                    <?php echo $row2['CotutorPD']; ?>
                                                    <br>
                                                    <b name = "TipoPD">Tipo proyecto: </b>
                                                    <?php echo $row2['TipoPD']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarPD<?php echo $contador2; ?>" id="formBorrarPD<?php echo $contador2; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="ProyectosDirigidos">
                                                    <input type="hidden" name="evento" value="borrarProyectoDirigido">
                                                    <input type="hidden" name="CodigoPD" value="<?php echo $row2['CodigoPD']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row2['LoginU'] ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=ProyectosDirigidos&evento=consultarProyectoDirigido&CodigoPD=<?php echo $row2['CodigoPD']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmPD('formBorrarPD<?php echo $contador2; ?>', '<?php echo $row2['TituloPD']." ".$row2['CodigoPD']; ?>');">
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
                    <!-- listado de TFM -->
                    <div class="tab-pane fade in" id="tab4">
                        <?php
                        $lista3 = $_SESSION["listarProyectosDirigidosTFMAdmin"];
                        $contador3   = 1;
                        if (isset($lista3)) {
                            foreach ($lista3 as $row3){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- titulo proyecto -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "TituloPD" ><?php echo $row3['TituloPD']; ?></td>
                                        </div>
                                        <!-- datos proyecto-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "CodigoPD" >Código proyecto:</b>
                                                    <?php echo $row3['CodigoPD']; ?>
                                                    <br>
                                                    <b name = "LoginU" >Tutor:</b>
                                                    <?php echo $row3['LoginU']; ?>
                                                    <br>
                                                    <b name = "AlumnoPD">Alumno: </b>
                                                    <?php echo $row3['AlumnoPD']; ?>
                                                    <br>
                                                    <b  name = "FechaLecturaPD" >Fecha lectura: </b>
                                                    <?php echo $row3['FechaLecturaPD']; ?>
                                                    <br>
                                                    <b name = "CalificacionPD">Calificacion: </b>
                                                    <?php echo $row3['CalificacionPD']; ?>
                                                    <br>
                                                    <b name = "URLPD">URL: </b>
                                                    <?php echo $row3['URLPD']; ?>
                                                    <br>
                                                    <b name = "CotutorPD">Cotutor: </b>
                                                    <?php echo $row3['CotutorPD']; ?>
                                                    <br>
                                                    <b name = "TipoPD">Tipo proyecto: </b>
                                                    <?php echo $row3['TipoPD']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarPD<?php echo $contador3; ?>" id="formBorrarPD<?php echo $contador3; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="ProyectosDirigidos">
                                                    <input type="hidden" name="evento" value="borrarProyectoDirigido">
                                                    <input type="hidden" name="CodigoPD" value="<?php echo $row3['CodigoPD']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row3['LoginU'] ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=ProyectosDirigidos&evento=consultarProyectoDirigido&CodigoPD=<?php echo $row3['CodigoPD']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmPD('formBorrarPD<?php echo $contador3; ?>', '<?php echo $row3['TituloPD']." ".$row3['CodigoPD']; ?>');">
                                                        Borrar
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                $contador3++;
                            }
                        }
                        ?>

                    </div>


                </div>
            </div>

            <!-- Confirmar borrar ProyectoDirigido -->
            <div id="confirmBorrarPD" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-danger">
                            <h4 class="modal-title">Atención</h4>
                        </div>
                        <div class="modal-body text-center">
                            <h5>¿Desea eliminar la proyecto de <strong class="nombre"></strong>?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                            <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN: Confirmar borrar ProyectoDirigido -->
            <?php
            // Pie y cierre de html, body
            require_once 'View/Structure/Footer.php';
            ?>
