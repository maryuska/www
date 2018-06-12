<?php
session_start();
////////
if(!isset( $_SESSION["TipoUsuario"])){
    $tipo = NULL;
}else {
    $tipo = $_SESSION["TipoUsuario"];
}

if(!isset($tipo)){
    Visitante();
}else {
    switch ($tipo) {
        case 'U':
            Usuario();
            break;
        case 'A':
            Administrador();
            break;
        default:
            echo "Problemas en el Nav";
            break;
    }
}
////////


function Visitante(){
?>

    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand " href="#"><img  src="../../lib/icons/kurriculum_icono.png" ></a>

            </div>
            <div  class="navbar-collapse collapse navbar-ex2-collapse">



                <!-- LOGIN-->
                <ul class=" nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" > Login <b class="caret"></b></a>
                        <ul class=" boxlogin dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <form class="form-group " action="../../Controller/UsuariosController.php" method="post">
                                <label class=" control-label"> Login Usuario </label>
                                <div >
                                    <input id="LoginU" name="LoginU" type="text" placeholder="Login Usuario" class="form-control" required>
                                </div>
                                <label class=" control-label"> Password </label>
                                <div >
                                    <input id="PasswordU" name="PasswordU" type="text" placeholder="Password" class="form-control" required>
                                </div>

                                <p align="center"><input  type="submit" name="evento" value="Login" class="btn btn-orange "></p>
                            </form>
                            <li class="divider"></li>

                        </ul>
                    </li>
                    <!-- Fin LOGIN -->
                    <li ><a class="nounderline" href="../../lib/registrarse.php">Registrarse</a></li>


                <!-- Search -->

                <form  class="navbar-form navbar-right form-inline" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="search" title="Buscar en el sistema" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" title="Buscar en el sistema" class="btn btn-default" value="search"><i class="glyphicon glyphicon-search"></i> </button>
                            </div>
                        </div>
                    </div>

                </form>




            </div>
        </div>

</nav>
    <!-- Content -->
    <div class="container col-md-2">

       <div>
            <p class="lead text-center">Visitante</p>
           <!--menu lateral izquierdo-->

       </div>

    </div>

<?php
}


function Usuario(){
    ?>
<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand " href="../../View/Usuario/consultarUsuario.php"><img  src="../../lib/icons/kurriculum_icono.png" ></a>

        </div>
        <div  class="navbar-collapse collapse navbar-ex2-collapse">


            <!-- dropdown user-->

            <ul class=" nav navbar-nav navbar-right">
                <li class="dropdown" >
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">User<span class="caret"></span> </a>
                    <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                        <li ><a href="modificarUsuario.php">Modificar Perfil</a></li>
                        <li ><a href="../../Controller/UsuariosController.php?evento=logOut" id='logOut'>Logout</a></li>

                    </ul>
                </li>
            </ul>
            <!--Logout-->

            <!-- Search -->

            <form  class="navbar-form navbar-right form-inline" role="search">
                <div class="form-group">
                    <div class="input-group">
                        <input type="search" title="Buscar en el sistema" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" title="Buscar en el sistema" class="btn btn-default" value="search"><i class="glyphicon glyphicon-search"></i> </button>
                        </div>
                    </div>
                </div>

            </form>




        </div>
    </div>
</nav>

<!-- Content -->

<div class="container col-md-2 ">
    <div class="row">

        <div class="">
            <div>
              <?php  $loginU =$_SESSION["loginU"]; ?>
                <!--usuario logueado-->
                <p class="lead text-center"> <?php echo $loginU; ?></p>
                <!--menu lateral izquierdo-->

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Usuarios </a>
                        <ul class=" dropdown-menu   ">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/UsuariosController.php?evento=listarUsuarios'"> Listar Usuarios</a> <Br>
                            <a class="subopciones" href="../Usuario/buscarUsuarios.php">Buscar Usuarios</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Artículos </a>
                        <ul class=" dropdown-menu   ">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/ArticulosController.php?evento=listarArticulos'"> Listar Artículos</a> <Br>
                            <a class="subopciones" href="../Articulo/insertarArticulo.php">Alta Artículo</a><br>
                            <a class="subopciones" href="../Articulo/buscarArticulo.php">Buscar Artículos</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Congresos </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/CongresosController.php?evento=listarCongresos'"> Listar Congresos</a> <Br>
                            <a class="subopciones" href="../Congreso/insertarCongreso.php">Alta Congreso</a><br>
                            <a class="subopciones" href="../Congreso/buscarCongresos.php">Buscar Congresos</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Estancias </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/EstanciasController.php?evento=listarEstancias'"> Listar Estancias</a> <Br>
                            <a class="subopciones" href="../Estancia/insertarEstancia.php">Alta Estancia</a><br>
                            <a class="subopciones" href="../Estancia/buscarEstancias.php">Buscar Estancias</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Libros </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/LibrosController.php?evento=listarLibros'"> Listar Libros</a> <Br>
                            <a class="subopciones" href="../Libro/insertarLibro.php">Alta Libro</a><br>
                            <a class="subopciones" href="../Libro/buscarLibro.php">Buscar Libros</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Ponencias </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/PonenciasController.php?evento=listarPonencias'"> Listar Ponencias</a> <Br>
                            <a class="subopciones" href="../Ponencia/insertarPonencia.php">Alta Ponencia</a><br>
                            <a class="subopciones" href="../Ponencia/buscarPonencias.php">Buscar Ponencias</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Proyectos </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosController.php?evento=listarProyectos'"> Listar Proyectos</a> <Br>
                            <a class="subopciones" href="../Proyecto/insertarProyecto.php">Alta Proyecto</a><br>
                            <a class="subopciones" href="../Proyecto/buscarProyectos.php">Buscar Proyectos</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Proyectos dirigidos </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosDirigidosController.php?evento=listarProyectosDirigidos'"> Listar Proy.Dirigidos</a> <Br>
                            <a class="subopciones" href="../ProyectoDirigido/insertarProyectoDirigido.php">Alta Proy.Dirigido</a><br>
                            <a class="subopciones" href="../ProyectoDirigido/buscarProyectosDirigido.php">Buscar Proy.Dirigidos</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">TAD </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/TadController.php?evento=listarTAD'"> Listar TAD</a> <Br>
                            <a class="subopciones" href="../Tad/insertarTad.php">Alta TAD</a><br>
                            <a class="subopciones" href="../Tad/buscarTad.php">Buscar TAD</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">technicareport </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/TechnicalreportController.php?evento=listarTechnicalreport'"> Listar Technicalreport</a> <Br>
                            <a class="subopciones" href="../Technicalreport/insertarTechnicalreport.php">Alta Technicalreport</a><br>
                            <a class="subopciones" href="../Technicalreport/buscarTechnicalreport.php">Buscar Technicalreport</a><br>
                        </ul>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" href="#" data-toggle="dropdown">Materias </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/MateriasController.php?evento=listarMaterias'"> Listar Materias</a> <Br>
                            <a class="subopciones" href="../Materia/insertarMateria.php">Alta Materia</a><br>
                            <a class="subopciones" href="../Materia/buscarMateria.php">Buscar Materia</a><br>
                        </ul>
                    </li>
                </ul>


            </div>

        </div>
    </div>
</div>
</body>

</html>
  <?php
}

function Administrador(){
    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand " href="../../View/Usuario/consultarUsuario.php"><img  src="../../lib/icons/kurriculum_icono.png" ></a>

            </div>
            <div  class="navbar-collapse collapse navbar-ex2-collapse">


                <!-- dropdown user-->

                <ul class=" nav navbar-nav navbar-right">
                    <li class="dropdown" >
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">User<span class="caret"></span> </a>
                        <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <li ><a href="modificarUsuario.php">Modificar Perfil</a></li>
                            <li ><a href="../../Controller/UsuariosController.php?evento=logOut" id='logOut'>Logout</a></li>

                        </ul>
                    </li>
                </ul>
                <!--Logout-->

                <!-- Search -->

                <form  class="navbar-form navbar-right form-inline" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="search" title="Buscar en el sistema" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" title="Buscar en el sistema" class="btn btn-default" value="search"><i class="glyphicon glyphicon-search"></i> </button>
                            </div>
                        </div>
                    </div>

                </form>




            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container col-md-2 ">
        <div class="row">

            <div class="">
                <div>
                    <?php  $loginU =$_SESSION["loginU"]; ?>
                    <!--usuario logueado-->
                    <p class="lead text-center"> <?php echo $loginU; ?></p>
                    <!--menu lateral izquierdo-->

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Usuarios </a>
                            <ul class=" dropdown-menu   ">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/UsuariosController.php?evento=listarUsuariosAdmin'"> Listar Usuarios</a> <Br>
                                <a class="subopciones" href="../Usuario/altaUsuarioAdmin.php">Alta Usuario</a><br>
                                <a class="subopciones" href="../Usuario/buscarUsuarios.php">Buscar Usuarios</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Artículos </a>
                            <ul class=" dropdown-menu   ">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/ArticulosController.php?evento=listarArticulos'"> Listar Artículos</a> <Br>
                                <a class="subopciones" href="../Articulo/insertarArticulo.php">Alta Artículo</a><br>
                                <a class="subopciones" href="../Articulo/buscarArticulo.php">Buscar Artículos</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Congresos </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/CongresosController.php?evento=listarCongresos'"> Listar Congresos</a> <Br>
                                <a class="subopciones" href="../Congreso/insertarCongreso.php">Alta Congreso</a><br>
                                <a class="subopciones" href="../Congreso/buscarCongresos.php">Buscar Congresos</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Estancias </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/EstanciasController.php?evento=listarEstancias'"> Listar Estancias</a> <Br>
                                <a class="subopciones" href="../Estancia/insertarEstancia.php">Alta Estancia</a><br>
                                <a class="subopciones" href="../Estancia/buscarEstancias.php">Buscar Estancias</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Libros </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/LibrosController.php?evento=listarLibros'"> Listar Libros</a> <Br>
                                <a class="subopciones" href="../Libro/insertarLibro.php">Alta Libro</a><br>
                                <a class="subopciones" href="../Libro/buscarLibro.php">Buscar Libros</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Ponencias </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/PonenciasController.php?evento=listarPonencias'"> Listar Ponencias</a> <Br>
                                <a class="subopciones" href="../Ponencia/insertarPonencia.php">Alta Ponencia</a><br>
                                <a class="subopciones" href="../Ponencia/buscarPonencias.php">Buscar Ponencias</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Proyectos </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosController.php?evento=listarProyectos'"> Listar Proyectos</a> <Br>
                                <a class="subopciones" href="../Proyecto/insertarProyecto.php">Alta Proyecto</a><br>
                                <a class="subopciones" href="../Proyecto/buscarProyectos.php">Buscar Proyectos</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Proyectos dirigidos </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosDirigidosController.php?evento=listarProyectosDirigidos'"> Listar Proy.Dirigidos</a> <Br>
                                <a class="subopciones" href="../ProyectoDirigido/insertarProyectoDirigido.php">Alta Proy.Dirigido</a><br>
                                <a class="subopciones" href="../ProyectoDirigido/buscarProyectosDirigido.php">Buscar Proy.Dirigidos</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">TAD </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/TadController.php?evento=listarTAD'"> Listar TAD</a> <Br>
                                <a class="subopciones" href="../Tad/insertarTad.php">Alta TAD</a><br>
                                <a class="subopciones" href="../Tad/buscarTad.php">Buscar TAD</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Technicareport </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/TechnicalreportController.php?evento=listarTechnicalreport'"> Listar Technicalreport</a> <Br>
                                <a class="subopciones" href="../Technicalreport/insertarTechnicalreport.php">Alta Technicalreport</a><br>
                                <a class="subopciones" href="../Technicalreport/buscarTechnicalreport.php">Buscar Technicalreport</a><br>
                            </ul>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" href="#" data-toggle="dropdown">Materias </a>
                            <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                                <a class="subopciones" type='submit' name = 'accion' onclick="location.href = '../../Controller/MateriasController.php?evento=listarMaterias'"> Listar Materias</a> <Br>
                                <a class="subopciones" href="../Materia/insertarMateria.php">Alta Materia</a><br>
                                <a class="subopciones" href="../Materia/buscarMateria.php">Buscar Materia</a><br>
                            </ul>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
    </body>

    </html>
    <?php
}

?>
