
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
            <p class="lead separator separator-title">Lista de Materias</p>

            <!--Tabs-nav opciones-->
            <div class="clearfix">
                <!--Tabs-nav-->
                <ul class="nav nav-tabs">
                    <li class="active "><a title="Materias mas recientes " href="#tab1" data-toggle="tab">Mas recientes</a></li>
                    <li ><a title="Materias de Grado" href="#tab2" data-toggle="tab">Grado</a></li>
                    <li ><a title="Materias de Tercer Ciclo" href="#tab3" data-toggle="tab">Tercer Ciclo</a></li>
                    <li ><a title="Materias de Master" href="#tab4" data-toggle="tab">Master</a></li>
                    <li ><a title="Materias de Postgrado" href="#tab5" data-toggle="tab">Postgrado</a></li>
                    <li ><a title="Materias de Cursos" href="#tab6" data-toggle="tab">Cursos</a></li>


                </ul>

            </div>

                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Materias" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarMateria" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Materias&evento=paginaInsertarMateria">
                                Insertar materia
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>



            <div class="tab-content">
<!--listado de materias  -->
                <div class="tab-pane fade in active" id="tab1">
                    <?php
                    $lista = $_SESSION["listarMaterias"];
                    $contador   = 1;
                    if (isset($lista)) {
                    foreach ($lista as $row){ ?>

                    <div class="form-group col-lg-6">
                        <div class="panel panel-default">
                            <!-- Nombre materia -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "DenominacionM" ><?php echo $row['DenominacionM']; ?></td>
                            </div>
                            <!-- datos proyecto-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b name = "CodigoM" >Código Materia:</b>
                                        <?php echo $row['CodigoM']; ?>
                                        <br>
                                        <b name = "TipoM">Tipo de materia: </b>
                                        <?php echo $row['TipoM']; ?>
                                        <br>
                                        <b  name = "TipoParticipacionM" >Tipo participación: </b>
                                        <?php echo $row['TipoParticipacionM']; ?>
                                        <br>
                                        <b name = "TitulacionM">Titulación: </b>
                                        <?php echo $row['TitulacionM']; ?>
                                        <br>
                                        <b name = "AnhoAcademicoM">Año académico: </b>
                                        <?php echo $row['AnhoAcademicoM']; ?>
                                        <br>
                                        <b name = "CreditosM">Creditos: </b>
                                        <?php echo $row['CreditosM']; ?>
                                        <br>
                                        <b name = "CuatrimestreM">Cuatrimestre: </b>
                                        <?php echo $row['CuatrimestreM']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <div class="margin-bottom5 text-center">
                                    <form name="formBorrarMateria<?php echo $contador; ?>" id="formBorrarMateria<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                        <input type="hidden" name="controlador" value="Materias">
                                        <input type="hidden" name="evento" value="borrarMateria">
                                        <input type="hidden" name="CodigoM" value="<?php echo $row['CodigoM']; ?>">
                                        <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Materias&evento=consultarMateria&CodigoM=<?php echo $row['CodigoM']; ?>'">
                                            Modificar
                                        </button>
                                        <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarMateria('formBorrarMateria<?php echo $contador; ?>', '<?php echo $row['DenominacionM']." ".$row['CodigoM']; ?>');">
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
                    $lista1 = $_SESSION["listarMateriasGrado"];
                    $contador1   = 1;
                    if (isset($lista1)) {
                        foreach ($lista1 as $row1){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- titulo proyecto -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "DenominacionM" ><?php echo $row1['DenominacionM']; ?></td>
                                    </div>
                                    <!-- datos proyecto-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoM" >Código Materia:</b>
                                                <?php echo $row1['CodigoM']; ?>
                                                <br>
                                                <b name = "TipoM">Tipo de materia: </b>
                                                <?php echo $row1['TipoM']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionM" >Tipo participación: </b>
                                                <?php echo $row1['TipoParticipacionM']; ?>
                                                <br>
                                                <b name = "TitulacionM">Titulación: </b>
                                                <?php echo $row1['TitulacionM']; ?>
                                                <br>
                                                <b name = "AnhoAcademicoM">Año académico: </b>
                                                <?php echo $row1['AnhoAcademicoM']; ?>
                                                <br>
                                                <b name = "CreditosM">Creditos: </b>
                                                <?php echo $row1['CreditosM']; ?>
                                                <br>
                                                <b name = "CuatrimestreM">Cuatrimestre: </b>
                                                <?php echo $row1['CuatrimestreM']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarMateria<?php echo $contador1; ?>" id="formBorrarMateria<?php echo $contador1; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Materias">
                                                <input type="hidden" name="evento" value="borrarMateria">
                                                <input type="hidden" name="CodigoM" value="<?php echo $row1['CodigoM']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Materias&evento=consultarMateria&CodigoM=<?php echo $row1['CodigoM']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarMateria('formBorrarMateria<?php echo $contador1; ?>', '<?php echo $row1['CodigoM']." ".$row1['DenominacionM']; ?>');">
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
                    $lista2 = $_SESSION["listarMateriasTCiclo"];
                    $contador2   = 1;
                    if (isset($lista2)) {
                        foreach ($lista2 as $row2){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- titulo proyecto -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "DenominacionM" ><?php echo $row2['DenominacionM']; ?></td>
                                    </div>
                                    <!-- datos proyecto-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoM" >Código Materia:</b>
                                                <?php echo $row2['CodigoM']; ?>
                                                <br>
                                                <b name = "TipoM">Tipo de materia: </b>
                                                <?php echo $row2['TipoM']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionM" >Tipo participación: </b>
                                                <?php echo $row2['TipoParticipacionM']; ?>
                                                <br>
                                                <b name = "TitulacionM">Titulación: </b>
                                                <?php echo $row2['TitulacionM']; ?>
                                                <br>
                                                <b name = "AnhoAcademicoM">Año académico: </b>
                                                <?php echo $row2['AnhoAcademicoM']; ?>
                                                <br>
                                                <b name = "CreditosM">Creditos: </b>
                                                <?php echo $row2['CreditosM']; ?>
                                                <br>
                                                <b name = "CuatrimestreM">Cuatrimestre: </b>
                                                <?php echo $row2['CuatrimestreM']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarMateria<?php echo $contador2; ?>" id="formBorrarMateria<?php echo $contador2; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Materias">
                                                <input type="hidden" name="evento" value="borrarMateria">
                                                <input type="hidden" name="CodigoM" value="<?php echo $row2['CodigoM']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Materias&evento=consultarMateria&CodigoM=<?php echo $row2['CodigoM']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarMateria('formBorrarMateria<?php echo $contador2; ?>', '<?php echo $row2['CodigoM']." ".$row2['DenominacionM']; ?>');">
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
                    $lista3 = $_SESSION["listarMateriasMaster"];
                    $contador3   = 1;
                    if (isset($lista3)) {
                        foreach ($lista3 as $row3){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- titulo proyecto -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "DenominacionM" ><?php echo $row3['DenominacionM']; ?></td>
                                    </div>
                                    <!-- datos proyecto-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoM" >Código Materia:</b>
                                                <?php echo $row3['CodigoM']; ?>
                                                <br>
                                                <b name = "TipoM">Tipo de materia: </b>
                                                <?php echo $row3['TipoM']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionM" >Tipo participación: </b>
                                                <?php echo $row3['TipoParticipacionM']; ?>
                                                <br>
                                                <b name = "TitulacionM">Titulación: </b>
                                                <?php echo $row3['TitulacionM']; ?>
                                                <br>
                                                <b name = "AnhoAcademicoM">Año académico: </b>
                                                <?php echo $row3['AnhoAcademicoM']; ?>
                                                <br>
                                                <b name = "CreditosM">Creditos: </b>
                                                <?php echo $row3['CreditosM']; ?>
                                                <br>
                                                <b name = "CuatrimestreM">Cuatrimestre: </b>
                                                <?php echo $row3['CuatrimestreM']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarMateria<?php echo $contador3; ?>" id="formBorrarMateria<?php echo $contador3; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Materias">
                                                <input type="hidden" name="evento" value="borrarMateria">
                                                <input type="hidden" name="CodigoM" value="<?php echo $row3['CodigoM']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Materias&evento=consultarMateria&CodigoM=<?php echo $row3['CodigoM']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarMateria('formBorrarMateria<?php echo $contador3; ?>', '<?php echo $row3['CodigoM']." ".$row3['DenominacionM']; ?>');">
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

                <!-- listado de materias de post grado -->
                <div class="tab-pane fade" id="tab5">
                    <?php
                    $lista4 = $_SESSION["listarMateriasPost"];
                    $contador4   = 1;
                    if (isset($lista4)) {
                        foreach ($lista4 as $row4){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- titulo proyecto -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "DenominacionM" ><?php echo $row4['DenominacionM']; ?></td>
                                    </div>
                                    <!-- datos proyecto-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoM" >Código Materia:</b>
                                                <?php echo $row4['CodigoM']; ?>
                                                <br>
                                                <b name = "TipoM">Tipo de materia: </b>
                                                <?php echo $row4['TipoM']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionM" >Tipo participación: </b>
                                                <?php echo $row4['TipoParticipacionM']; ?>
                                                <br>
                                                <b name = "TitulacionM">Titulación: </b>
                                                <?php echo $row4['TitulacionM']; ?>
                                                <br>
                                                <b name = "AnhoAcademicoM">Año académico: </b>
                                                <?php echo $row4['AnhoAcademicoM']; ?>
                                                <br>
                                                <b name = "CreditosM">Creditos: </b>
                                                <?php echo $row4['CreditosM']; ?>
                                                <br>
                                                <b name = "CuatrimestreM">Cuatrimestre: </b>
                                                <?php echo $row4['CuatrimestreM']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarMateria<?php echo $contador4; ?>" id="formBorrarMateria<?php echo $contador4; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Materias">
                                                <input type="hidden" name="evento" value="borrarMateria">
                                                <input type="hidden" name="CodigoM" value="<?php echo $row4['CodigoM']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Materias&evento=consultarMateria&CodigoM=<?php echo $row4['CodigoM']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarMateria('formBorrarMateria<?php echo $contador4; ?>', '<?php echo $row4['CodigoM']." ".$row4['DenominacionM']; ?>');">
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

                <!-- listado de materias de cursos -->
                <div class="tab-pane fade" id="tab6">
                    <?php
                    $lista5 = $_SESSION["listarMateriasCursos"];
                    $contador5   = 1;
                    if (isset($lista5)) {
                        foreach ($lista5 as $row5){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- titulo proyecto -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "DenominacionM" ><?php echo $row5['DenominacionM']; ?></td>
                                    </div>
                                    <!-- datos proyecto-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoM" >Código Materia:</b>
                                                <?php echo $row5['CodigoM']; ?>
                                                <br>
                                                <b name = "TipoM">Tipo de materia: </b>
                                                <?php echo $row5['TipoM']; ?>
                                                <br>
                                                <b  name = "TipoParticipacionM" >Tipo participación: </b>
                                                <?php echo $row5['TipoParticipacionM']; ?>
                                                <br>
                                                <b name = "TitulacionM">Titulación: </b>
                                                <?php echo $row5['TitulacionM']; ?>
                                                <br>
                                                <b name = "AnhoAcademicoM">Año académico: </b>
                                                <?php echo $row5['AnhoAcademicoM']; ?>
                                                <br>
                                                <b name = "CreditosM">Creditos: </b>
                                                <?php echo $row5['CreditosM']; ?>
                                                <br>
                                                <b name = "CuatrimestreM">Cuatrimestre: </b>
                                                <?php echo $row5['CuatrimestreM']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarMateria<?php echo $contador5; ?>" id="formBorrarMateria<?php echo $contador5; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Materias">
                                                <input type="hidden" name="evento" value="borrarMateria">
                                                <input type="hidden" name="CodigoM" value="<?php echo $row['CodigoM']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Materias&evento=consultarMateria&CodigoM=<?php echo $row5['CodigoM']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarMateria('formBorrarMateria<?php echo $contador5; ?>', '<?php echo $row5['CodigoM']." ".$row5['DenominacionM']; ?>');">
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
            </div>
            </div>

            </div>
    </div>


</div>
<!-- Confirmar borrar materia -->
<div id="confirmBorrarMateria" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar la metria de <strong class="DenominacionM"></strong>?</h5>
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
