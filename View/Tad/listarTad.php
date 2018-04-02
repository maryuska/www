<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>
        <!-- derecha  -->
        <div class="col-md-10">

            <!--Titulo de lo que se esta haciendo -->
            <p class="lead separator separator-title">Lista TAD</p>

            <div class="tab-content">
<!--listado de Tads  -->

                    <?php
                    $lista = $_SESSION["listarTads"];
                    if (isset($lista)) {
                    foreach ($lista as $row){ ?>

                    <div class="form-group col-lg-6">
                        <div class="panel panel-default">
                            <!-- titulo TAD -->
                            <div class="tdTitulo">
                                <td type="submit"   name = "TituloTAD" ><?php echo $row['TituloTAD']; ?></td>
                            </div>
                            <!-- datos TAD-->
                            <div class="panel-body">
                                <tr>
                                    <td valign="top" width="50%">
                                        <b name = "CodigoTAD" >Código TAD:</b>
                                        <?php echo $row['CodigoTAD']; ?>
                                        <br>
                                        <b  name = "AlumnoTAD" >Alumno: </b>
                                        <?php echo $row['AlumnoTAD']; ?>
                                        <br>
                                        <b name = "FechaLecturaTAD">Fecha lectura: </b>
                                        <?php echo $row['FechaLecturaPD']; ?>
                                        <br>
                                    </td>

                                </tr>
                                <p align="center">
                                    <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/TadController.php?evento=consultarProyectoDirigido&CodigoPD=<?php echo $row['CodigoTAD']; ?>'">Modificar</button>
                                </p>
                            </div>
                        </div>

                    <?php } } ?>
                </div>
        </div>
    </div>



