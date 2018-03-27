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
                    <li class="active "><a title="Estancias mas recientes " href="#tab1" data-toggle="tab">Mas recientes</a></li>
                    <li ><a title="Estancias de Investigación" href="#tab2" data-toggle="tab">Investigación</a></li>
                    <li ><a title="Estancias de Doctorado" href="#tab3" data-toggle="tab">Doctorado</a></li>
                    <li ><a title="Estancias de invitado" href="#tab4" data-toggle="tab">Invitado</a></li>


                </ul>

            </div>

            <!--Titulo de lo que se esta haciendo -->
            <p class="lead separator separator-title">Lista de Estancias</p>

            <div class="tab-content">
<!--listado de estancias  -->
                <div class="tab-pane fade in active" id="tab1">
                    <?php
                    $lista = $_SESSION["listarEstancias"];
                    if (isset($lista)) {
                    foreach ($lista as $row){ ?>

                    <div class="form-group col-lg-6">
                        <div class="panel panel-default">

                            <div class="tdTitulo">
                                <td type="submit"   name = "CentroE" ><?php echo $row['CentroE']; ?></td>
                            </div>
                            <!-- datos estancia -->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b name = "CodigoE" >Código Estancia:</b>
                                        <?php echo $row['CodigoE']; ?>
                                        <br>
                                        <b  name = "UniversidadE" >Universidad: </b>
                                        <?php echo $row['UniversidadE']; ?>
                                        <br>
                                        <b name = "PaisE">País: </b>
                                        <?php echo $row['PaisE']; ?>
                                        <br>
                                        <b name = "FechaInicioE">Fecha Inicio: </b>
                                        <?php echo $row['FechaInicioE']; ?>
                                        <br>
                                        <b name = "FechaFinE">Fecha Fin: </b>
                                        <?php echo $row['FechaFinE']; ?>
                                        <br>
                                        <b name = "TipoE">Tipo: </b>
                                        <?php echo $row['TipoE']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <p align="center">
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/EstanciasController.php?evento=consultarEstancia&CodigoE=<?php echo $row['CodigoE']; ?>'">Modificar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>


<!--listado de estancias de investigacion-->
                <div class="tab-pane fade" id="tab2">
                    <?php
                    $lista1 = $_SESSION["listarEstanciasInvestigacion"];
                    if (isset($lista1)) {
                        foreach ($lista1 as $row1){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">

                                    <div class="tdTitulo">
                                        <td type="submit"   name = "CentroE" ><?php echo $row1['CentroE']; ?></td>
                                    </div>
                                    <!-- datos estancia -->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoE" >Código Estancia:</b>
                                                <?php echo $row1['CodigoE']; ?>
                                                <br>
                                                <b  name = "UniversidadE" >Universidad: </b>
                                                <?php echo $row1['UniversidadE']; ?>
                                                <br>
                                                <b name = "PaisE">País: </b>
                                                <?php echo $row1['PaisE']; ?>
                                                <br>
                                                <b name = "FechaInicioE">Fecha Inicio: </b>
                                                <?php echo $row1['FechaInicioE']; ?>
                                                <br>
                                                <b name = "FechaFinE">Fecha Fin: </b>
                                                <?php echo $row1['FechaFinE']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/EstanciasController.php?evento=consultarEstancia&CodigoE=<?php echo $row1['CodigoE']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                </div>
<!--listado de TFG -->
                <div class="tab-pane fade " id="tab3">
                    <?php
                    $lista2 = $_SESSION["listarEstanciasDoctorado"];
                    if (isset($lista2)) {
                        foreach ($lista2 as $row2){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">

                                    <div class="tdTitulo">
                                        <td type="submit"   name = "CentroE" ><?php echo $row2['CentroE']; ?></td>
                                    </div>
                                    <!-- datos estancia -->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoE" >Código Estancia:</b>
                                                <?php echo $row2['CodigoE']; ?>
                                                <br>
                                                <b  name = "UniversidadE" >Universidad: </b>
                                                <?php echo $row2['UniversidadE']; ?>
                                                <br>
                                                <b name = "PaisE">País: </b>
                                                <?php echo $row2['PaisE']; ?>
                                                <br>
                                                <b name = "FechaInicioE">Fecha Inicio: </b>
                                                <?php echo $row2['FechaInicioE']; ?>
                                                <br>
                                                <b name = "FechaFinE">Fecha Fin: </b>
                                                <?php echo $row2['FechaFinE']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/EstanciasController.php?evento=consultarEstancia&CodigoE=<?php echo $row2['CodigoE']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                </div>
<!-- listado de TFM -->
                <div class="tab-pane fade" id="tab4">
                    <?php
                    $lista3 = $_SESSION["listarEstanciasInvitado"];
                    if (isset($lista3)) {
                        foreach ($lista3 as $row3){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">

                                    <div class="tdTitulo">
                                        <td type="submit"   name = "CentroE" ><?php echo $row3['CentroE']; ?></td>
                                    </div>
                                    <!-- datos estancia -->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoE" >Código Estancia:</b>
                                                <?php echo $row3['CodigoE']; ?>
                                                <br>
                                                <b  name = "UniversidadE" >Universidad: </b>
                                                <?php echo $row3['UniversidadE']; ?>
                                                <br>
                                                <b name = "PaisE">País: </b>
                                                <?php echo $row3['PaisE']; ?>
                                                <br>
                                                <b name = "FechaInicioE">Fecha Inicio: </b>
                                                <?php echo $row3['FechaInicioE']; ?>
                                                <br>
                                                <b name = "FechaFinE">Fecha Fin: </b>
                                                <?php echo $row3['FechaFinE']; ?>
                                                <br>
                                            </td>

                                        </tr>
                                        <p align="center">
                                            <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/EstanciasController.php?evento=consultarEstancia&CodigoE=<?php echo $row3['CodigoE']; ?>'">Modificar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                </div>

        </div>
    </div>



