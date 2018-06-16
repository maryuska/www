<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';
$LoginU = $_SESSION["loginU"];
?>
<!-- derecha  -->
<div class="col-md-10">

    <!--Tabs-nav opciones-->
    <div class="clearfix">
        <!--Tabs-nav-->
        <ul class="nav nav-tabs">
            <li class="active "><a title="Proyectos mas recientes " href="#tab1" data-toggle="tab">Mas recientes</a></li>
            <li ><a title="Proyectos fin de carreira" href="#tab2" data-toggle="tab">PFC</a></li>
            <li ><a title="Proyectos fin de grado" href="#tab3" data-toggle="tab">PFG</a></li>
            <li ><a title="Proyectos fin de master" href="#tab4" data-toggle="tab">TFM</a></li>


        </ul>

    </div>

    <!--Titulo de lo que se esta haciendo -->
    <p class="lead separator separator-title">Lista Proyectos Dirigidos</p><br>
    <!-- boton buscar-->

    <div class="center-block col-lg-6 col-md-6 col-xs-6 " >
        <form class="navbar-form text-center " action="../../Controller/ProyectosDirigidosController.php" method="POST" role="search">
            <div class=" col-lg-3 col-md-3 col-xs-3 " >

                <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
            </div>
            <div class="col-lg-6 col-md-6 col-xs-6 " >
                <button type="submit" name="evento" value="buscarProyectoDirigido" class="btn btn-orange center-block">Buscar</button>
            </div>
        </form>
    </div>
    <!-- boton insertar-->
    <div class="form-group col-lg-6">
        <p align="center">
            <button type="button" class="btn btn-orange " onclick="window.location.href='../ProyectoDirigido/insertarProyectoDirigidoAdmin.php'">Insertar Proyecto Dirigido</button>
        </p>

    </div>



    <div class="tab-content">
        <!--listado de proyectos dirigidos  -->
        <div class="tab-pane fade in active" id="tab1">
            <?php
            $lista = $_SESSION["listarProyectosDirigidosAdmin"];
            if (isset($lista)) {
                foreach ($lista as $row){ ?>

                    <div class="form-group col-lg-4">
                        <div class="panel panel-default">
                            <!-- titulo proyecto -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "TituloPD" ><?php echo $row['TituloPD']; ?></td>
                            </div>
                            <!-- datos proyecto-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b name = "CodigoPD" >Código Proyecto:</b>
                                        <?php echo $row['CodigoPD']; ?>
                                        <br>
                                        <b name = "LoginU" >Login:</b>
                                        <?php echo $row['LoginU']; ?>
                                        <br>
                                        <b  name = "AlumnoPD" >Alumno: </b>
                                        <?php echo $row['AlumnoPD']; ?>
                                        <br>
                                        <b name = "CalificacionPD">Calificación: </b>
                                        <?php echo $row['CalificacionPD']; ?>
                                        <br>
                                        <b name = "FechaLecturaPD">Fecha lectura: </b>
                                        <?php echo $row['FechaLecturaPD']; ?>
                                        <br>
                                        <b name = "CotutorPD">Cotutor: </b>
                                        <?php echo $row['CotutorPD']; ?>
                                        <br>
                                        <b name = "URLPD">URL: </b>
                                        <?php echo $row['URLPD']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <p align="center ">
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=consultarProyectoDirigido&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Modificar</button>
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=confirmarBorrado&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Borrar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } } ?>

        </div>


        <!--listado de TFC-->
        <div class="tab-pane fade" id="tab2">
            <?php
            $lista = $_SESSION["listarProyectosDirigidosTFCAdmin"];
            if (isset($lista)) {
                foreach ($lista as $row){ ?>
                    <div class="form-group col-lg-4">
                        <div class="panel panel-default">
                            <!-- titulo proyecto -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "TituloPD" ><?php echo $row['TituloPD']; ?></td>
                            </div>
                            <!-- datos proyecto-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b>Código Proyecto: </b>
                                        <?php echo $row['CodigoPD']; ?>
                                        <br>
                                        <b name = "LoginU" >Login:</b>
                                        <?php echo $row['LoginU']; ?>
                                        <br>
                                        <b>Alumno: </b>
                                        <?php echo $row['AlumnoPD']; ?>
                                        <br>
                                        <b>Calificación: </b>
                                        <?php echo $row['CalificacionPD']; ?>
                                        <br>
                                        <b>Fecha lectura: </b>
                                        <?php echo $row['FechaLecturaPD']; ?>
                                        <br>
                                        <b>Cotutor: </b>
                                        <?php echo $row['CotutorPD']; ?>
                                        <br>
                                        <b>URL: </b>
                                        <?php echo $row['URLPD']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <p align="center ">
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=consultarProyectoDirigido&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Modificar</button>
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=confirmarBorrado&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Borrar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } } ?>

        </div>
        <!--listado de TFG -->
        <div class="tab-pane fade " id="tab3">
            <?php
            $lista = $_SESSION["listarProyectosDirigidosTFGAdmin"];
            if (isset($lista)) {
                foreach ($lista as $row){ ?>
                    <div class="form-group col-lg-4">
                        <div class="panel panel-default">
                            <!-- titulo proyecto -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "TituloPD" ><?php echo $row['TituloPD']; ?></td>

                            </div>
                            <!-- datos proyecto-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b>Código Proyecto: </b>
                                        <?php echo $row['CodigoPD']; ?>
                                        <br>
                                        <b name = "LoginU" >Login:</b>
                                        <?php echo $row['LoginU']; ?>
                                        <br>
                                        <b>Alumno: </b>
                                        <?php echo $row['AlumnoPD']; ?>
                                        <br>
                                        <b>Calificación: </b>
                                        <?php echo $row['CalificacionPD']; ?>
                                        <br>
                                        <b>Fecha lectura: </b>
                                        <?php echo $row['FechaLecturaPD']; ?>
                                        <br>
                                        <b>Cotutor: </b>
                                        <?php echo $row['CotutorPD']; ?>
                                        <br>
                                        <b>URL: </b>
                                        <?php echo $row['URLPD']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <p align="center ">
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=consultarProyectoDirigido&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Modificar</button>
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=confirmarBorrado&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Borrar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } } ?>

        </div>
        <!-- listado de TFM -->
        <div class="tab-pane fade" id="tab4">
            <?php
            $lista = $_SESSION["listarProyectosDirigidosTFMAdmin"];
            if (isset($lista)) {
                foreach ($lista as $row){ ?>
                    <div class="form-group col-lg-4">
                        <div class="panel panel-default">
                            <!-- titulo proyecto -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "TituloPD" ><?php echo $row['TituloPD']; ?></td>
                            </div>
                            <!-- datos proyecto-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b>Código Proyecto: </b>
                                        <?php echo $row['CodigoPD']; ?>
                                        <br>
                                        <b name = "LoginU" >Login:</b>
                                        <?php echo $row['LoginU']; ?>
                                        <br>
                                        <b>Alumno: </b>
                                        <?php echo $row['AlumnoPD']; ?>
                                        <br>
                                        <b>Calificación: </b>
                                        <?php echo $row['CalificacionPD']; ?>
                                        <br>
                                        <b>Fecha lectura: </b>
                                        <?php echo $row['FechaLecturaPD']; ?>
                                        <br>
                                        <b>Cotutor: </b>
                                        <?php echo $row['CotutorPD']; ?>
                                        <br>
                                        <b>URL: </b>
                                        <?php echo $row['URLPD']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <p align="center ">
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=consultarProyectoDirigido&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Modificar</button>
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/ProyectosDirigidosController.php?evento=confirmarBorrado&CodigoPD=<?php echo $row['CodigoPD']; ?>'">Borrar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } } ?>

        </div>


    </div>
</div>



