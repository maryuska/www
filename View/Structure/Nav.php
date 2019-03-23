<?php
if(!isset($_SESSION))
    session_start();
////////
if(!isset( $_SESSION["TipoUsuario"])){
    $tipo = NULL;
}else {
    $tipo = $_SESSION["TipoUsuario"];
}

if(!isset($tipo)){
    NavVisitante();
}else {
    switch ($tipo) {
        case 'U':
        case 'A':
            NavLogueado();
        break;
        default:
            echo "Problemas en el Nav";
        break;
    }
}
////////


function NavVisitante(){
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
                <a class="navbar-brand">
                    <img src="View/Structure/lib/icons/kurriculum_icono.png" class="logotipo">
                </a>
            </div>
            <div  class="navbar-collapse collapse navbar-ex2-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="nounderline" href="index.php?controlador=Usuarios&evento=registrarse">
                            Registrarse
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}


function NavLogueado(){
    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">

                <!-- Icono menu responsive nav -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Logotipo -->
                <a class="navbar-brand" href="index.php?controlador=Usuarios&evento=consultarUsuarioActual">
                    <img src="View/Structure/lib/icons/kurriculum_icono.png" class="logotipo">
                </a>

                <!-- Icono menu responsive sidebar -->
                <button type="button" class="navbar-toggle collapsed navbar-sidebar" data-toggle="collapse" data-target=".navbar-sidebar-collapse">
                    <span class="icon-bar icon-bar-orange"></span>
                    <span class="icon-bar icon-bar-orange"></span>
                    <span class="icon-bar icon-bar-orange"></span>
                </button>

            </div>
            <div  class="navbar-collapse collapse navbar-ex2-collapse">

                <!-- Opciones del usuario -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown" >
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            User<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <li>
                                <a href="index.php?controlador=Usuarios&evento=paginaModificarUsuario">
                                    Modificar Perfil
                                </a>
                            </li>
                            <li>
                                <a href="index.php?controlador=Usuarios&evento=logOut" id='logOut'>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

<?php
}
?>
