<?php

require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';



?>
<!-- derecha  -->
<div class="col-md-10">
<p class="lead separator separator-title">Lista Usuarios</p>
    <br>
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
    <!-- boton insertar-->
    <div class="form-group col-lg-6">
        <p align="center">
            <button type="button" class="btn btn-orange " onclick="window.location.href='../Usuario/altaUsuarioAdmin.php'">Insertar usuario</button>
        </p>

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
                            <div class=" col-lg-2 col-md-2 col-xs-2 " ></div>
                            <div class=" col-lg-4 col-md-4 col-xs-4 " >
                                <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/UsuariosController.php?evento=consultarDetalleUsuario&LoginU=<?php echo $row['LoginU']; ?>'">Consultar</button>
                            </div>
                            <div class=" col-lg-4 col-md-4 col-xs-4 " >
                                <button type="button" class="btn btn-orange " onclick="window.location.href='../../Controller/UsuariosController.php?evento=confirmarBorrado&LoginU=<?php echo $row['LoginU']; ?>'">Borrar</button>
                            </div>
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
