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

                    <li ><a class="nounderline" href="../../View/login.php">Login</a></li>

                    <!-- Fin LOGIN -->
                    <li ><a class="nounderline" href="../../View/Usuario/registrarse.php">Registrarse</a></li>






            </div>
        </div>

</nav>
    <!-- Content -->
    <div class="container col-md-2">

       <div>
            <p class="lead text-center"></p>
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
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/UsuariosController.php?evento=listarUsuarios'"> Usuarios</a>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/ArticulosController.php?evento=listarArticulos'"> Artículos</a>
                    </li>
                </ul>


                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/CongresosController.php?evento=listarCongresos'"> Congresos</a>
                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/LibrosController.php?evento=listarLibros'"> Libros</a>

                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/PonenciasController.php?evento=listarPonencias'"> Ponencias</a>

                    </li>
                </ul>
                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosController.php?evento=listarProyectos'"> Proyectos</a>

                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosDirigidosController.php?evento=listarProyectosDirigidos&LoginU=<?php echo $loginU; ?>'"> Proyectos dirigidos</a>

                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/TADController.php?evento=listarTAD&LoginU=<?php echo $loginU; ?>'"> TAD</a>

                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/TechnicareportController.php?evento=listarTechnicareport&LoginU=<?php echo $loginU; ?>'"> Technicareport</a>

                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/MateriasController.php?evento=listarMaterias&LoginU=<?php echo $loginU; ?>'"> Materias</a>

                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/EstanciasController.php?evento=listarEstancias&LoginU=<?php echo $loginU; ?>'"> Estancias</a>

                    </li>
                </ul>

                <ul class=" list-col  ">
                    <li class="dropdown" >
                        <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/TesisController.php?evento=listarTesis&LoginU=<?php echo $loginU; ?>'"> Tesis</a>

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
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/UsuariosController.php?evento=listarUsuariosAdmin'"> Usuarios</a>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/ArticulosController.php?evento=listarArticulos'"> Artículos</a>
                        </li>
                    </ul>


                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/CongresosController.php?evento=listarCongresos'"> Congresos</a>
                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/LibrosController.php?evento=listarLibros'"> Libros</a>

                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/PonenciasController.php?evento=listarPonencias'"> Ponencias</a>

                        </li>
                    </ul>
                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosController.php?evento=listarProyectos'"> Proyectos</a>

                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/ProyectosDirigidosController.php?evento=listarProyectosDirigidos'"> Proyectos dirigidos</a>

                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/TadController.php?evento=listarTAD&LoginU=<?php echo $loginU; ?>'"> TAD</a>

                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/TechnicareportController.php?evento=listarTechnicareport&LoginU=<?php echo $loginU; ?>'"> Technicareport</a>

                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/MateriasController.php?evento=listarMaterias&LoginU=<?php echo $loginU; ?>'"> Materias</a>

                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/EstanciasController.php?evento=listarEstancias&LoginU=<?php echo $loginU; ?>'"> Estancias</a>

                        </li>
                    </ul>

                    <ul class=" list-col  ">
                        <li class="dropdown" >
                            <a class="options" type='submit' name = 'accion' onclick="location.href = '../../Controller/TesisController.php?evento=listarTesis&LoginU=<?php echo $loginU; ?>'"> Tesis</a>

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
