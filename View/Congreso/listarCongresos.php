
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
            <p class="lead separator separator-title">Lista de congresos</p>

            <!--Tabs-nav opciones-->
            <div class="clearfix">
                <!--Tabs-nav-->
                <ul class="nav nav-tabs">
                    <li class="active "><a title="Congresos mas recientes " href="#tab1" data-toggle="tab">Mas recientes</a></li>
                    <li ><a title="Congresos MCO" href="#tab2" data-toggle="tab">MCO</a></li>
                    <li ><a title="Congresos MCC" href="#tab3" data-toggle="tab">MCC</a></li>
                    <li ><a title="Congresos R" href="#tab4" data-toggle="tab">R</a></li>
                    <li ><a title="Congresos C" href="#tab5" data-toggle="tab">C</a></li>
                    <li ><a title="Congresos PCO" href="#tab6" data-toggle="tab">PCO</a></li>
                    <li ><a title="Congresos PCC" href="#tab7" data-toggle="tab">PCC</a></li>
                </ul>
            </div>

                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Congresos" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarCongreso" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Congresos&evento=paginaInsertarCongreso">
                                Insertar congreso
                            </a>
                        </div>
                    </form>
                </div>
                <br>
                <br>
            <div class="tab-content">
<!--listado de congresos  -->
                <div class="tab-pane fade in active" id="tab1">
                    <?php
                    $lista = $_SESSION["listarCongresos"];
                    $contador   = 1;
                    if (isset($lista)) {
                    foreach ($lista as $row){ ?>

                    <div class="form-group col-lg-6">
                        <div class="panel panel-default">
                            <!--  -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "NombreC" ><?php echo $row['NombreC']; ?></td>
                            </div>
                            <!-- datos congreso-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b name = "CodigoC" >Código congreso:</b>
                                        <?php echo $row['CodigoC']; ?>
                                        <br>
                                        <b name = "AcronimoC">Acronimo: </b>
                                        <?php echo $row['AcronimoC']; ?>
                                        <br>
                                        <b  name = "TipoParticipacionC" >Tipo participación: </b>
                                        <?php echo $row['TipoParticipacionC']; ?>
                                        <br>
                                        <b name = "LugarC">Lugar: </b>
                                        <?php echo $row['LugarC']; ?>
                                        <br>
                                        <b name = "AnhoC">Año: </b>
                                        <?php echo $row['AnhoC']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <div class="margin-bottom5 text-center">
                                    <form name="formBorrarCongreso<?php echo $contador; ?>" id="formBorrarCongreso<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                        <input type="hidden" name="controlador" value="Congresos">
                                        <input type="hidden" name="evento" value="borrarCongreso">
                                        <input type="hidden" name="CodigoC" value="<?php echo $row['CodigoC']; ?>">
                                        <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Congresos&evento=consultarCongreso&CodigoC=<?php echo $row['CodigoC']; ?>'">
                                            Modificar
                                        </button>
                                        <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarCongreso('formBorrarCongreso<?php echo $contador; ?>', '<?php echo $row['CodigoC']." ".$row['NombreC']; ?>');">
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
<!--listado de congresos MCO -->
                <div class="tab-pane fade" id="tab2">
                    <?php
                    $lista1 = $_SESSION["listarCongresosMCO"];
                    $contador1   = 1;
                    if (isset($lista1)) {
                        foreach ($lista1 as $row1){ ?>
                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- titulo  -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "NombreC" ><?php echo $row1['NombreC']; ?></td>
                                    </div>
                                    <!-- datos congreso-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoC" >Código congreso:</b>
                                                <?php echo $row1['CodigoC']; ?>
                                                <br>
                                                <b name = "AcronimoC">Acronimo: </b>
                                                <?php echo $row1['AcronimoC']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionC" >Tipo participación: </b>
                                                <?php echo $row1['TipoParticipacionC']; ?>
                                                <br>
                                                <b name = "LugarC">Lugar: </b>
                                                <?php echo $row1['LugarC']; ?>
                                                <br>
                                                <b name = "AnhoC">Año: </b>
                                                <?php echo $row1['AnhoC']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarCongreso<?php echo $contador1; ?>" id="formBorrarCongreso<?php echo $contador1; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Congresos">
                                                <input type="hidden" name="evento" value="borrarCongreso">
                                                <input type="hidden" name="CodigoC" value="<?php echo $row['CodigoC']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Congresos&evento=consultarCongreso&CodigoC=<?php echo $row1['CodigoC']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarCongreso('formBorrarCongreso<?php echo $contador1; ?>', '<?php echo $row1['CodigoC']." ".$row1['NombreC']; ?>');">
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

                <!--listado  de congresos MCC-->
                <div class="tab-pane fade " id="tab3">
                    <?php
                    $lista2 = $_SESSION["listarCongresosMCC"];
                    $contador2   = 1;
                    if (isset($lista2)) {
                        foreach ($lista2 as $row2){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!--  -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "NombreC" ><?php echo $row2['NombreC']; ?></td>
                                    </div>
                                    <!-- datos congreso-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoC" >Código congreso:</b>
                                                <?php echo $row2['CodigoC']; ?>
                                                <br>
                                                <b name = "AcronimoC">Acronimo: </b>
                                                <?php echo $row2['AcronimoC']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionC" >Tipo participación: </b>
                                                <?php echo $row2['TipoParticipacionC']; ?>
                                                <br>
                                                <b name = "LugarC">Lugar: </b>
                                                <?php echo $row2['LugarC']; ?>
                                                <br>
                                                <b name = "AnhoC">Año: </b>
                                                <?php echo $row2['AnhoC']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarCongreso<?php echo $contador2; ?>" id="formBorrarCongreso<?php echo $contador2; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Congresos">
                                                <input type="hidden" name="evento" value="borrarCongreso">
                                                <input type="hidden" name="CodigoC" value="<?php echo $row2['CodigoC']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Congresos&evento=consultarCongreso&CodigoC=<?php echo $row2['CodigoC']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarCongreso('formBorrarCongreso<?php echo $contador2; ?>', '<?php echo $row2['CodigoC']." ".$row2['NombreC']; ?>');">
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

                <!-- listado de congresos R -->
                <div class="tab-pane fade" id="tab4">
                    <?php
                    $lista3 = $_SESSION["listarCongresosR"];
                    $contador3   = 1;
                    if (isset($lista3)) {
                        foreach ($lista3 as $row3){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!--  -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "NombreC" ><?php echo $row['NombreC']; ?></td>
                                    </div>
                                    <!-- datos congreso-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoC" >Código congreso:</b>
                                                <?php echo $row3['CodigoC']; ?>
                                                <br>
                                                <b name = "AcronimoC">Acronimo: </b>
                                                <?php echo $row3['AcronimoC']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionC" >Tipo participación: </b>
                                                <?php echo $row3['TipoParticipacionC']; ?>
                                                <br>
                                                <b name = "LugarC">Lugar: </b>
                                                <?php echo $row3['LugarC']; ?>
                                                <br>
                                                <b name = "AnhoC">Año: </b>
                                                <?php echo $row3['AnhoC']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarCongreso<?php echo $contador3; ?>" id="formBorrarCongreso<?php echo $contador3; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Congresos">
                                                <input type="hidden" name="evento" value="borrarCongreso">
                                                <input type="hidden" name="CodigoC" value="<?php echo $row3['CodigoC']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Congresos&evento=consultarCongreso&CodigoC=<?php echo $row3['CodigoC']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarCongreso('formBorrarCongreso<?php echo $contador3; ?>', '<?php echo $row3['CodigoC']." ".$row3['NombreC']; ?>');">
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

                <!-- listado de congresos C -->
                <div class="tab-pane fade" id="tab5">
                    <?php
                    $lista4 = $_SESSION["listarCongresosC"];
                    $contador4   = 1;
                    if (isset($lista4)) {
                        foreach ($lista4 as $row4){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!--  -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "NombreC" ><?php echo $row4['NombreC']; ?></td>
                                    </div>
                                    <!-- datos congreso-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoC" >Código congreso:</b>
                                                <?php echo $row4['CodigoC']; ?>
                                                <br>
                                                <b name = "AcronimoC">Acronimo: </b>
                                                <?php echo $row4['AcronimoC']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionC" >Tipo participación: </b>
                                                <?php echo $row4['TipoParticipacionC']; ?>
                                                <br>
                                                <b name = "LugarC">Lugar: </b>
                                                <?php echo $row4['LugarC']; ?>
                                                <br>
                                                <b name = "AnhoC">Año: </b>
                                                <?php echo $row4['AnhoC']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarCongreso<?php echo $contador4; ?>" id="formBorrarCongreso<?php echo $contador4; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Congresos">
                                                <input type="hidden" name="evento" value="borrarCongreso">
                                                <input type="hidden" name="CodigoC" value="<?php echo $row4['CodigoC']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Congresos&evento=consultarCongreso&CodigoC=<?php echo $row4['CodigoC']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarCongreso('formBorrarCongreso<?php echo $contador4; ?>', '<?php echo $row4['CodigoC']." ".$row4['NombreC']; ?>');">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     <?php
                            $contador4++;
                        }
                    }
                    ?>

                </div>

                <!-- listado de congresos PCO-->
                <div class="tab-pane fade" id="tab6">
                    <?php
                    $lista5 = $_SESSION["listarCongresosPCO"];
                    $contador5   = 1;
                    if (isset($lista5)) {
                        foreach ($lista5 as $row5){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!--  -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "NombreC" ><?php echo $row5['NombreC']; ?></td>
                                    </div>
                                    <!-- datos congreso-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoC" >Código congreso:</b>
                                                <?php echo $row5['CodigoC']; ?>
                                                <br>
                                                <b name = "AcronimoC">Acronimo: </b>
                                                <?php echo $row5['AcronimoC']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionC" >Tipo participación: </b>
                                                <?php echo $row5['TipoParticipacionC']; ?>
                                                <br>
                                                <b name = "LugarC">Lugar: </b>
                                                <?php echo $row5['LugarC']; ?>
                                                <br>
                                                <b name = "AnhoC">Año: </b>
                                                <?php echo $row5['AnhoC']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarCongreso<?php echo $contador5; ?>" id="formBorrarCongreso<?php echo $contador5; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Congresos">
                                                <input type="hidden" name="evento" value="borrarCongreso">
                                                <input type="hidden" name="CodigoC" value="<?php echo $row5['CodigoC']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Congresos&evento=consultarCongreso&CodigoC=<?php echo $row5['CodigoC']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarCongreso('formBorrarCongreso<?php echo $contador5; ?>', '<?php echo $row5['CodigoC']." ".$row5['NombreC']; ?>');">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     <?php
                            $contador5++;
                        }
                    }
                    ?>



                </div>

                <!-- listado de congresos PCC   -->
                <div class="tab-pane fade " id="tab7">
                    <?php
                    $lista6 = $_SESSION["listarCongresosPCC"];
                    $contador6   = 1;
                    if (isset($lista6)) {
                        foreach ($lista6 as $row6){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!--  -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "NombreC" ><?php echo $row6['NombreC']; ?></td>
                                    </div>
                                    <!-- datos congreso-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoC" >Código congreso:</b>
                                                <?php echo $row6['CodigoC']; ?>
                                                <br>
                                                <b name = "AcronimoC">Acronimo: </b>
                                                <?php echo $row6['AcronimoC']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionC" >Tipo participación: </b>
                                                <?php echo $row6['TipoParticipacionC']; ?>
                                                <br>
                                                <b name = "LugarC">Lugar: </b>
                                                <?php echo $row6['LugarC']; ?>
                                                <br>
                                                <b name = "AnhoC">Año: </b>
                                                <?php echo $row6['AnhoC']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarCongreso<?php echo $contador6; ?>" id="formBorrarCongreso<?php echo $contador6; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Congresos">
                                                <input type="hidden" name="evento" value="borrarCongreso">
                                                <input type="hidden" name="CodigoC" value="<?php echo $row6['CodigoC']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Congresos&evento=consultarCongreso&CodigoC=<?php echo $row6['CodigoC']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarCongreso('formBorrarCongreso<?php echo $contador6; ?>', '<?php echo $row6['CodigoC']." ".$row6['NombreC']; ?>');">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $contador6++;
                        }
                    }
                    ?>


                </div>

            </div>
            </div>

            </div>
    </div>


</div>
<!-- Confirmar borrar congreso -->
<div id="confirmBorrarCongreso" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar el congreso <strong class="Nombre"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar congreso -->
<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
