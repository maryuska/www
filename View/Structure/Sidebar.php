<?php

if(!isset($_SESSION))
    session_start();

if(!isset( $_SESSION["TipoUsuario"])){
    $tipo = NULL;
}else {
    $tipo = $_SESSION["TipoUsuario"];
}

// Sidebar

if(isset($tipo) && ($tipo == 'A' || $tipo == 'U')){ 

    // Obtenemos el usuario en session
    $loginU = $_SESSION["loginU"];

?>

<div class="col-md-2">
    <nav class="navbar" role="navigation">
        <div  class="navbar-collapse collapse navbar-sidebar-collapse">
            <ul class="nav">

                <li class="sidebar-options">
                    <!-- Usuario logueado -->
                    <p class="text-center">
                        <?php echo $loginU; ?>
                    </p>
                </li>

                <?php
                // Sidebar según el tipo de usuario
                if($tipo == 'A'){
                    sidebarAdministrador($loginU);
                }
                elseif($tipo == 'U'){
                    sidebarUsuario($loginU);
                }
                ?>
            </ul>
        </div>
    </nav>
</div>

<?php
}

// Fin Sidebar




/**
 * Sidebar Usuario
 */
function sidebarUsuario($loginU){
?>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Usuarios&evento=listarUsuarios">
            Usuarios
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Articulos&evento=listarArticulos">
            Artículos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Congresos&evento=listarCongresos">
            Congresos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Libros&evento=listarLibros">
            Libros
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Ponencias&evento=listarPonencias">
            Ponencias
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Proyectos&evento=listarProyectos">
            Proyectos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=<?php echo $loginU; ?>">
            Proyectos dirigidos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=TAD&evento=listarTad&LoginU=<?php echo $loginU; ?>">
            TAD
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Technicareport&evento=listarTechnicareport&LoginU=<?php echo $loginU; ?>">
            Technicareport
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Materias&evento=listarMaterias&LoginU=<?php echo $loginU; ?>">
            Materias
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Estancias&evento=listarEstancias&LoginU=<?php echo $loginU; ?>">
            Estancias
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Tesis&evento=listarTesis&LoginU=<?php echo $loginU; ?>">
            Tesis
        </a>
    </li>
<?php
}

function sidebarAdministrador($loginU){
?>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Usuarios&evento=listarUsuariosAdmin">
            Usuarios
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Articulos&evento=listarArticulos">
            Artículos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Congresos&evento=listarCongresos">
            Congresos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Libros&evento=listarLibros">
            Libros
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Ponencias&evento=listarPonencias">
            Ponencias
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Proyectos&evento=listarProyectos">
            Proyectos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin">
            Proyectos dirigidos
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Tad&evento=listarTadAdmin">
            TAD
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Technicareport&evento=listarTechnicareport&LoginU=<?php echo $loginU; ?>">
            Technicareport
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Materias&evento=listarMateriasAdmin">
            Materias
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Estancias&evento=listarEstanciasAdmin">
            Estancias
        </a>
    </li>
    <li class="sidebar-options">
        <a class="nounderline" href="index.php?controlador=Tesis&evento=listarTesisAdmin">
            Tesis
        </a>
    </li>
    <?php
}

?>
