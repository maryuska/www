<?php

require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';

$usuario = $_SESSION["listarUsuarios"];

?>
<!-- derecha  -->
<div class="col-md-10">
    <p class="lead separator separator-title">Lista Usuarios</p>
    <!-- boton buscar-->

    <div class="center-block col-lg-6 col-md-6 col-xs-6 " >
        <form class="navbar-form text-center " action="../../Controller/UsuariosController.php" method="POST" role="search">
            <div class=" col-lg-3 col-md-3 col-xs-3 " >

                <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
            </div>
            <div class="col-lg-6 col-md-6 col-xs-6 " >
                <button type="submit" name="evento" value="buscarUsuario" class="btn btn-orange center-block">Buscar</button>
            </div>
        </form>
    </div>

    <div class="form-group col-lg-6">
        <br>
        <br>
        <br>
    </div>

    <div class="tab-content">
        <!--listado de proyectos dirigidos  -->
        <?php
        $lista = $_SESSION["listarUsuarios"];
        if (isset($lista)) {
            foreach ($lista as $row){ ?>

                <div class="form-group col-lg-6">
                    <div class="panel panel-default">
                        <!-- login usuario -->
                        <div class="tdTitulo">
                            <td type="submit"   name = "LoginU" ><?php echo $row['LoginU']; ?></td>
                        </div>
                        <!-- datos usuario-->
                        <div class="panel-body">
                            <tr>
                                <td valign="top" width="50%">
                                    <b name = "NombreU" >Nombre:</b>
                                    <?php echo $row['NombreU']; ?>
                                    <br>
                                    <b  name = "ApellidosU" >Apellidos: </b>
                                    <?php echo $row['ApellidosU']; ?>
                                    <br>
                                    <b name = "Centro">Centro: </b>
                                    <?php echo $row['Centro']; ?>
                                    <br>
                                    <b name = "Departamento">Departamento: </b>
                                    <?php echo $row['Departamento']; ?>
                                    <br>
                                    <b name = "Mail">Mail: </b>
                                    <?php echo $row['Mail']; ?>
                                    <br>
                                </td>

                            </tr>
                            <p align="center">
                                 <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/UsuariosController.php?evento=consultarDetalleUsuario&LoginU=<?php echo $row['LoginU']; ?>'">Consultar</button>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } } ?>

    </div>
</div>
<?php

require_once '../../View/Structure/Footer.php';

?>
