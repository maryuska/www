<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>
        <!-- derecha  -->
        <div class="col-md-10">

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

            <!--Titulo de lo que se esta haciendo -->
            <p class="lead separator separator-title">Lista de Materias</p>



            <!-- boton buscar-->

            <div class="center-block col-lg-6 col-md-6 col-xs-6 " >
                <form class="navbar-form text-center " action="../../Controller/MateriasController.php" method="POST" role="search">
                    <div class=" col-lg-3 col-md-3 col-xs-3 " >

                        <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6 " >
                        <button type="submit" name="evento" value="buscarMateria" class="btn btn-orange center-block">Buscar</button>
                    </div>
                </form>
            </div>
            <!-- boton insertar-->
            <div class="form-group col-lg-6">
                <p align="center">
                    <button type="button" class="btn btn-orange " onclick="window.location.href='../Materia/insertarMateria.php'">Insertar Materia</button>
                </p>

            </div>



            <div class="tab-content">
<!--listado de materias  -->
                <div class="tab-pane fade in active" id="tab1">
                    <?php
                    $lista = $_SESSION["listarMaterias"];
                    if (isset($lista)) {
                    foreach ($lista as $row){ ?>

                    <div class="form-group col-lg-6">
                        <div class="panel panel-default">
                            <!-- titulo proyecto -->
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
                                <p align="center">
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/MateriasController.php?evento=consultarMateria&CodigoM=<?php echo $row['CodigoM']; ?>'">Modificar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                    <div class="form-group col-lg-10">
                        <p align="center">
                            <button type="button" class="btn btn-orange " onclick="window.location.href='insertarMateria.php'">Insertar Materia</button>
                        </p>
                    </div>
                </div>


<!--listado de materias de grado-->
                <div class="tab-pane fade" id="tab2">
                    <?php
                    $lista1 = $_SESSION["listarMateriasGrado"];
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
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/MateriasController.php?evento=consultarMateria&CodigoM=<?php echo $row1['CodigoM']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                    <div class="form-group col-lg-10">
                        <p align="center">
                            <button type="button" class="btn btn-orange " onclick="window.location.href='insertarMateria.php'">Insertar Materia</button>
                        </p>
                    </div>
                </div>

                <!--listado de materias de tercer ciclo -->
                <div class="tab-pane fade " id="tab3">
                    <?php
                    $lista2 = $_SESSION["listarMateriasTCiclo"];
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
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/MateriasController.php?evento=consultarMateria&CodigoM=<?php echo $row2['CodigoM']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                    <div class="form-group col-lg-10">
                        <p align="center">
                            <button type="button" class="btn btn-orange " onclick="window.location.href='insertarMateria.php'">Insertar Materia</button>
                        </p>
                    </div>
                </div>

                <!-- listado de materias de master -->
                <div class="tab-pane fade" id="tab4">
                    <?php
                    $lista3 = $_SESSION["listarMateriasMaster"];
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
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/MateriasController.php?evento=consultarMateria&CodigoM=<?php echo $row3['CodigoM']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                    <div class="form-group col-lg-10">
                        <p align="center">
                            <button type="button" class="btn btn-orange " onclick="window.location.href='insertarMateria.php'">Insertar Materia</button>
                        </p>
                    </div>
                </div>

                <!-- listado de materias de post grado -->
                <div class="tab-pane fade" id="tab5">
                    <?php
                    $lista = $_SESSION["listarMateriasPost"];
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
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/MateriasController.php?evento=consultarMateria&CodigoM=<?php echo $row4['CodigoM']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                    <div class="form-group col-lg-10">
                        <p align="center">
                            <button type="button" class="btn btn-orange " onclick="window.location.href='insertarMateria.php'">Insertar Materia</button>
                        </p>
                    </div>
                </div>

                <!-- listado de materias de cursos -->
                <div class="tab-pane fade" id="tab6">
                    <?php
                    $lista5 = $_SESSION["listarMateriasCursos"];
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
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/MateriasController.php?evento=consultarMateria&CodigoM=<?php echo $row5['CodigoM']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                    <div class="form-group col-lg-10">
                        <p align="center">
                            <button type="button" class="btn btn-orange " onclick="window.location.href='insertarMateria.php'">Insertar Materia</button>
                        </p>
                    </div>
                </div>


            </div>
    </div>



