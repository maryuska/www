<?php
session_start();
if(!isset( $_SESSION["loginU"])){
    $usuario = null;


}else {
    $usuario = $_SESSION["loginU"];


}


if(!isset($usuario)){
    Visitante();
}else {

     Usuario();

}
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




                <!-- LOGIN -->
                <ul class=" nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" > Login <b class="caret"></b></a>
                        <ul class=" boxlogin dropdown-menu dropdown-menu-left pull-right dropdown-login">
                            <form class="form-group " action="../Controller/UsuariosController.php" method="post">
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
                    <li ><a class="nounderline" href="Usuario/registrarse.php">Registrarse</a></li>

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

            <a class="navbar-brand " href="#"><img  src="../../lib/icons/kurriculum_icono.png" ></a>

        </div>
        <div  class="navbar-collapse collapse navbar-ex2-collapse">


            <!-- dropdown user-->

            <ul class=" nav navbar-nav navbar-right">
                <li class="dropdown" >
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">User<span class="caret"></span> </a>
                    <ul class=" dropdown-menu dropdown-menu-left pull-right dropdown-login">
                        <li ><a class="nounderline" href="#">Perfil</a></li>
                        <li ><a class="nounderline" href="#">Logout</a></li>

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

  <?php
}

?>
