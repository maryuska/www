
<?php

require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

?>

<div class="col-md-10 izquierda">
<div class="form-group col-lg-6">
    <div class="panel panel-default">


        <?php $rows = $_SESSION["ConsultarU"];

        foreach ($rows as $row) { ?>



        <div class="tdTitulo">
             Datos personales
        </div>

        <div class="panel-body">


            <div class="form-group">
                <label  for="LoginU">Login </label>
                <input id="LoginU" type="LoginU"  class="form-control"value="<?php echo $row['LoginU']; ?>" disabled>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label for="NombreU">Nombre </label>

                <input id="NombreU"  type="NombreU"  class="form-control "value="<?php echo $row['NombreU']; ?>" disabled>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label for="ApellidosU">Apellidos </label>

                <input id="ApellidosU"  type="ApellidosU"  class="form-control "value="<?php echo $row['ApellidosU']; ?>" disabled>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label  for="TipoContratoU">Tipo Contrato</label>

                <input id="TipoContratoU"  type="TipoContratoU"  class="form-control "value="<?php echo $row['TipoContrato']; ?>" disabled>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label for="CentroU">Centro</label>

                <input id="CentroU" type="CentroU" class="form-control "value="<?php echo $row['Centro']; ?>" disabled>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label  for="DepartamentoU">Departamento</label>

                <input id="DepartamentoU"  type="DepartamentoU"  class="form-control "value="<?php echo $row['Departamento']; ?>" disabled>
            </div>

            <!-- Button

            <a href="modificarUsuario.php" class="btn  btn-orange" value="Modificar Datos">Modificar Datos</a>

            -->
            </form>

            <?php } ?>





        </div>
    </div>
</div>



    <div class="form-group col-lg-6">
        <div class="panel panel-default">


            <?php  $rows2 = $_SESSION["ConsultaUT"];

            foreach ($rows2 as $row2) { ?>
                <div class="tdTitulo">
                     Títulos Académicos
                </div>

                <form  action="../../Controller/UsuariosController.php" method="post" role='form'>


                    <div class="text-center">

                        <table class="text-center ">
                            <tr>
                                <th class="text-center " width="200px" >Nombre</th>
                                <th class="text-center "  width="200px">Fecha</th>
                                <th class="text-center" width="200px">Centro</th>
                            </tr>
                        </table>

                        <table class="text-center ">

                            <tr>
                                <td class="text-center" width="200px" name = "NombreTitulo"><?php echo $row2['NombreTitulo']; ?> </td>
                                <td class="text-center" width="200px" name = "FechaTitulo"><?php echo $row2['FechaTitulo']; ?> </td>
                                <td class="text-center"  width="200px" name = "CentroTitulo"><?php echo $row2['CentroTitulo']; ?> </td>
                            </tr>
                        </table>
                    </div>
                </form>

            <?php } ?>

            </div>
        </div>



    <div class="form-group col-lg-6">
        <div class="panel panel-default">


            <?php  $rows3 = $_SESSION["ConsultaUA"];

            foreach ($rows3 as $row3) { ?>
                <div class="tdTitulo">
                     Universidades
                </div>

                <form  action="../../Controller/UsuariosController.php" method="post" role='form'>


                    <div class="text-center">

                        <table class="text-center ">
                            <tr>
                                <th class="text-center " width="200px" >Nombre</th>
                                <th class="text-center "  width="200px">Inicio</th>
                                <th class="text-center" width="200px">Fin</th>
                            </tr>
                        </table>

                        <table class="text-center ">

                            <tr>
                                <td class="text-center" width="200px" name = "NombreUniversidad"><?php echo $row3['NombreUniversidad']; ?> </td>
                                <td class="text-center" width="200px" name = "FechaInicio"><?php echo $row3['FechaInicio']; ?> </td>
                                <td class="text-center"  width="200px" name = "FechaFin"><?php echo $row3['FechaFin']; ?> </td>
                            </tr>
                        </table>
                    </div>
                </form>

            <?php } ?>

        </div>
    </div>

</div>





