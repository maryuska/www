
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
                <label  for="Telefono">Telefono</label>
                <input id="Telefono"  type="Telefono"  class="form-control "value="<?php echo $row['Telefono']; ?>" disabled>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label  for="Mail">Mail</label>
                <input id="Mail"  type="Mail"  class="form-control "value="<?php echo $row['Mail']; ?>" disabled>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label  for="DNI">DNI</label>
                <input id="DNI"  type="DNI"  class="form-control "value="<?php echo $row['DNI']; ?>" disabled>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label  for="FechaNacimiento">Fecha Nacimiento</label>
                <input id="FechaNacimiento"  type="date"  class="form-control "value="<?php echo $row['FechaNacimiento']; ?>" disabled>
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


            </form>

            <?php } ?>





        </div>
    </div>
    <p align="center">
        <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/UsuariosController.php?evento=borrarPerfil&LoginU=<?php echo $row['LoginU']; ?>'">Borrar Perfil</button>
    </p>
</div>



    <div class="form-group col-lg-6">
        <div class="panel panel-default">
            <div class="tdTitulo">
                Títulos Académicos
            </div>

            <?php  $rows2 = $_SESSION["ConsultaUT"];

            foreach ($rows2 as $row2) { ?>


                <form  action="../../Controller/UsuariosController.php" method="post" role='form'>


                    <div class="text-center">

                        <table class="text-center ">
                            <tr>
                                <th class="text-center " width="300px" >Nombre</th>
                                <th class="text-center "  width="300px">Fecha</th>
                                <th class="text-center" width="300px">Centro</th>
                                <th width="750px"></th>
                            </tr>
                        </table>

                        <table class="text-center ">

                            <tr>
                                <td class="text-center" width="250px" name = "NombreTitulo"><?php echo $row2['NombreTitulo']; ?> </td>
                                <td class="text-center" width="250px" name = "FechaTitulo"><?php echo $row2['FechaTitulo']; ?> </td>
                                <td class="text-center"  width="250px" name = "CentroTitulo"><?php echo $row2['CentroTitulo']; ?> </td>
                                <td width="150px"><a type="submit" class="btn  " onclick="window.location.href='../../Controller/UsuariosController.php?evento=consultarTituloAcademico&LoginU=<?php echo $row['LoginU']; ?>&NombreTitulo=<?php echo $row2['NombreTitulo']; ?>'" >Modificar</a></td>
                            </tr>
                        </table>
                    </div>
                </form>

            <?php } ?>
            <p align="center">
                <button type="button" class="btn btn-orange " onclick="window.location.href='../../View/TituloAcademico/insertarTituloAcademico.php';">Insertar</button>
            </p>

            </div>
        </div>



    <div class="form-group col-lg-6">
        <div class="panel panel-default">
            <div class="tdTitulo">
                Universidades
            </div>

            <?php  $rows3 = $_SESSION["ConsultaUA"];

            foreach ($rows3 as $row3) { ?>

                <form  action="../../Controller/UsuariosController.php" method="post" role='form'>

                        <table class="text-center ">
                            <tr>
                                <th class="text-center " width="250px" >Nombre</th>
                                <th class="text-center "  width="250px">Inicio</th>
                                <th class="text-center" width="250px">Fin</th>
                                <th width="750px"></th>
                            </tr>
                        </table>

                        <table class="text-center ">

                            <tr>
                                <td class="text-center" width="250px" name = "NombreUniversidad"><?php echo $row3['NombreUniversidad']; ?> </td>
                                <td class="text-center" width="250px" name = "FechaInicio"><?php echo $row3['FechaInicio']; ?> </td>
                                <td class="text-center"  width="250px" name = "FechaFin"><?php echo $row3['FechaFin']; ?> </td>
                                <td width="150px"><a type="submit" class="btn  " onclick="window.location.href='../../Controller/UsuariosController.php?evento=consultarUniversidad&LoginU=<?php echo $row['LoginU']; ?>&NombreTitulo=<?php echo $row2['NombreTitulo']; ?>'" >Modificar</a></td>
                            </tr>
                        </table>

                </form>

            <?php } ?>
            <p align="center">
                <button type="button" class="btn btn-orange " onclick="window.location.href='../../View/Universidad/insertarUniversidad.php';">Insertar</button>
            </p>

        </div>
    </div>


</div>





