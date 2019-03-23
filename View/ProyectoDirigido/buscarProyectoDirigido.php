<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>
<!-- derecha  -->
<div class="col-md-10">

    <!--Titulo de lo que se esta haciendo -->
    <p class="lead separator separator-title">Lista Proyectos Dirigidos</p>


    <div class="tab-content">

            <?php
            $lista = $_SESSION["listarBusquedaPD"];
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

                            </div>
                        </div>
                    </div>
                <?php } } ?>


    </div>
</div>


