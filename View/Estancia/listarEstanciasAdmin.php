
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
                <p class="lead separator separator-title">Lista de Estancias</p>

                <!--Tabs-nav opciones-->
                <div class="clearfix">
                    <!--Tabs-nav-->
                    <ul class="nav nav-tabs">
                        <li class="active "><a title="Materias mas recientes " href="#tab1" data-toggle="tab">Mas recientes</a></li>
                        <li ><a title="Materias de Grado" href="#tab2" data-toggle="tab">Investigacion</a></li>
                        <li ><a title="Materias de Tercer Ciclo" href="#tab3" data-toggle="tab">Doctorado</a></li>
                        <li ><a title="Materias de Master" href="#tab4" data-toggle="tab">Invitado</a></li>
                    </ul>

                </div>

                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Estancias" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarEstancia" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Estancias&evento=paginaInsertarEstanciaAdmin">
                                Insertar estancia
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>



                <div class="tab-content">
                    <!--listado de estancias ordenadas mas recientes  -->
                    <div class="tab-pane fade in active" id="tab1">
                        <?php
                        $lista = $_SESSION["listarEstanciasAdmin"];
                        $contador   = 1;
                        if (isset($lista)) {
                            foreach ($lista as $row){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- Codigo estancia -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "CodigoE" ><?php echo $row['CodigoE']; ?></td>
                                        </div>
                                        <!-- datos estancia-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "LoginU">Usuario: </b>
                                                    <?php echo $row['LoginU']; ?>
                                                    <br>
                                                    <b name = "CentroE" >Centro:</b>
                                                    <?php echo $row['CentroE']; ?>
                                                    <br>
                                                    <b name = "UniversidadE">Universidad: </b>
                                                    <?php echo $row['UniversidadE']; ?>
                                                    <br>
                                                    <b  name = "PaisE" >Pais: </b>
                                                    <?php echo $row['PaisE']; ?>
                                                    <br>
                                                    <b name = "FechaInicioE">Fecha inicio: </b>
                                                    <?php echo $row['FechaInicioE']; ?>
                                                    <br>
                                                    <b name = "FechaFinE">Fecha fin: </b>
                                                    <?php echo $row['FechaFinE']; ?>
                                                    <br>
                                                    <b name = "TipoE">Tipo de estancia: </b>
                                                    <?php echo $row['TipoE']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarEstancia<?php echo $contador; ?>" id="formBorrarEstancia<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Estancias">
                                                    <input type="hidden" name="evento" value="borrarEstancia">
                                                    <input type="hidden" name="CodigoE" value="<?php echo $row['CodigoE']; ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Estancias&evento=consultarEstancia&CodigoE=<?php echo $row['CodigoE']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarEstancia('formBorrarEstancia<?php echo $contador; ?>', '<?php echo $row['CodigoE']." ".$row['CentroE']; ?>');">
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


                    <!--listado de materias de grado-->
                    <div class="tab-pane fade" id="tab2">
                        <?php
                        $lista1 = $_SESSION["listarEstanciasInvestigacionAdmin"];
                        $contador1   = 1;
                        if (isset($lista1)) {
                            foreach ($lista1 as $row1){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- Codigo estancia -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "CodigoE" ><?php echo $row1['CodigoE']; ?></td>
                                        </div>
                                        <!-- datos estancia-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "LoginU">Usuario: </b>
                                                    <?php echo $row1['LoginU']; ?>
                                                    <br>
                                                    <b name = "CentroE" >Centro:</b>
                                                    <?php echo $row1['CentroE']; ?>
                                                    <br>
                                                    <b name = "UniversidadE">Universidad: </b>
                                                    <?php echo $row1['UniversidadE']; ?>
                                                    <br>
                                                    <b  name = "PaisE" >Pais: </b>
                                                    <?php echo $row1['PaisE']; ?>
                                                    <br>
                                                    <b name = "FechaInicioE">Fecha inicio: </b>
                                                    <?php echo $row1['FechaInicioE']; ?>
                                                    <br>
                                                    <b name = "FechaFinE">Fecha fin: </b>
                                                    <?php echo $row1['FechaFinE']; ?>
                                                    <br>
                                                    <b name = "TipoE">Tipo de estancia: </b>
                                                    <?php echo $row1['TipoE']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarEstancia<?php echo $contador1; ?>" id="formBorrarEstancia<?php echo $contador1; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Estancias">
                                                    <input type="hidden" name="evento" value="borrarEstancia">
                                                    <input type="hidden" name="CodigoE" value="<?php echo $row1['CodigoE']; ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Estancias&evento=consultarEstancia&CodigoE=<?php echo $row1['CodigoE']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarEstancia('formBorrarEstancia<?php echo $contador1; ?>', '<?php echo $row1['CodigoE']." ".$row1['CentroE']; ?>');">
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

                    <!--listado de materias de tercer ciclo -->
                    <div class="tab-pane fade " id="tab3">
                        <?php
                        $lista2 = $_SESSION["listarEstanciasDoctoradoAdmin"];
                        $contador2   = 1;
                        if (isset($lista2)) {
                            foreach ($lista2 as $row2){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- Codigo estancia -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "CodigoE" ><?php echo $row2['CodigoE']; ?></td>
                                        </div>
                                        <!-- datos estancia-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "LoginU">Usuario: </b>
                                                    <?php echo $row2['LoginU']; ?>
                                                    <br>
                                                    <b name = "CentroE" >Centro:</b>
                                                    <?php echo $row2['CentroE']; ?>
                                                    <br>
                                                    <b name = "UniversidadE">Universidad: </b>
                                                    <?php echo $row2['UniversidadE']; ?>
                                                    <br>
                                                    <b  name = "PaisE" >Pais: </b>
                                                    <?php echo $row2['PaisE']; ?>
                                                    <br>
                                                    <b name = "FechaInicioE">Fecha inicio: </b>
                                                    <?php echo $row2['FechaInicioE']; ?>
                                                    <br>
                                                    <b name = "FechaFinE">Fecha fin: </b>
                                                    <?php echo $row2['FechaFinE']; ?>
                                                    <br>
                                                    <b name = "TipoE">Tipo de estancia: </b>
                                                    <?php echo $row2['TipoE']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarEstancia<?php echo $contador2; ?>" id="formBorrarEstancia<?php echo $contador2; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Estancias">
                                                    <input type="hidden" name="evento" value="borrarEstancia">
                                                    <input type="hidden" name="CodigoE" value="<?php echo $row2['CodigoE']; ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Estancias&evento=consultarEstancia&CodigoE=<?php echo $row2['CodigoE']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarEstancia('formBorrarEstancia<?php echo $contador2; ?>', '<?php echo $row2['CodigoE']." ".$row2['CentroE']; ?>');">
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

                    <!-- listado de materias de master -->
                    <div class="tab-pane fade" id="tab4">
                        <?php
                        $lista3 = $_SESSION["listarEstanciasInvitadoAdmin"];
                        $contador3   = 1;
                        if (isset($lista3)) {
                            foreach ($lista3 as $row3){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- Codigo estancia -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "CodigoE" ><?php echo $row3['CodigoE']; ?></td>
                                        </div>
                                        <!-- datos estancia-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "LoginU">Usuario: </b>
                                                    <?php echo $row3['LoginU']; ?>
                                                    <br>
                                                    <b name = "CentroE" >Centro:</b>
                                                    <?php echo $row3['CentroE']; ?>
                                                    <br>
                                                    <b name = "UniversidadE">Universidad: </b>
                                                    <?php echo $row3['UniversidadE']; ?>
                                                    <br>
                                                    <b  name = "PaisE" >Pais: </b>
                                                    <?php echo $row3['PaisE']; ?>
                                                    <br>
                                                    <b name = "FechaInicioE">Fecha inicio: </b>
                                                    <?php echo $row3['FechaInicioE']; ?>
                                                    <br>
                                                    <b name = "FechaFinE">Fecha fin: </b>
                                                    <?php echo $row3['FechaFinE']; ?>
                                                    <br>
                                                    <b name = "TipoE">Tipo de estancia: </b>
                                                    <?php echo $row3['TipoE']; ?>
                                                    <br>
                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarEstancia<?php echo $contador3; ?>" id="formBorrarEstancia<?php echo $contador3; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Estancias">
                                                    <input type="hidden" name="evento" value="borrarEstancia">
                                                    <input type="hidden" name="CodigoE" value="<?php echo $row3['CodigoE']; ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Estancias&evento=consultarEstancia&CodigoE=<?php echo $row3['CodigoE']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarEstancia('formBorrarEstancia<?php echo $contador3; ?>', '<?php echo $row3['CodigoE']." ".$row3['CentroE']; ?>');">
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

        </div>
    </div>


</div>
<!-- Confirmar borrar materia -->
<div id="confirmBorrarEstancia" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar la estancia de <strong class="CodigoE"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar materia -->
<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
