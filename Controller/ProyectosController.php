<?php
// Controlador de congresos

require_once 'Model/Proyecto.php';
require_once 'Model/Usuarios.php';
require_once 'Controller/ControllerController.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

// Página insertar Proyecto
    case "paginaInsertarProyecto":
        require_once "View/Proyecto/insertarProyecto.php";
        break;
// Página insertar proyecto admin
    case "paginaInsertarProyectoAdmin":
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        require_once "View/Proyecto/insertarProyectoAdmin.php";
        break;

//Dar de alta un proyecto
    case 'altaProyecto':
    
        $Proyecto = new Proyecto($_POST["CodigoProy"],$_POST["TituloProy"],$_POST["EntidadFinanciadora"],$_POST["AcronimoProy"],$_POST["AnhoInicioProy"],$_POST["AnhoFinProy"],$_POST["Importe"]);
		$CodigoProy = $_REQUEST['CodigoProy'];
        $Login=$_REQUEST["Login"];
        $TipoParticipacionProy = $_REQUEST['TipoParticipacionProy'];

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $errores = $Proyecto->validarProyecto($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            if($tipou == 'U') {
                require_once "View/Proyecto/insertarProyecto.php";
            }else{
                require_once "View/Proyecto/insertarProyectoAdmin.php";
            }
        }
        else {

            $consultaP = $Proyecto->ConsultarProyecto($CodigoProy);

            if (mysqli_num_rows($consultaP) > 0) {    // Existe el proyecto

                $errores = array("CodigoProy", "TituloProy", "EntidadFinanciadora", "AcronimoProy", "AnhoInicioProy", "AnhoFinProy", "Importe");
                $msgError = "El proyecto : " . $_POST["CodigoProy"] . "ya existe, no puede insertar el mismo.";

                if ($tipou == 'U') {
                    require_once "View/Proyecto/insertarProyecto.php";
                } else {
                    require_once "View/Proyecto/insertarProyectoAdmin.php";
                }

            } else {
                $Proyecto->AltaProyecto();
                $Proyecto->Participa($CodigoProy, $Login, $TipoParticipacionProy);
                if ($tipou == 'U') {
                    header("Location: index.php?controlador=Proyectos&evento=listarProyectos&LoginU=$Login");
                } else {
                    header("Location: index.php?controlador=Proyectos&evento=listarProyectosAdmin");
                }
            }
        }

        break;

//Consultar un proyecto para modificar
    case 'consultarProyecto':

        $proyecto = new Proyecto("","","","","","","");
        $CodigoProy = $_REQUEST['CodigoProy'];
        $consultaP = $proyecto->ConsultarProyecto($CodigoProy);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaP)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarProyecto"] = $consulta;

        require_once "View/Proyecto/modificarProyecto.php";

        break;

//Consultar un proyecto para modificar como admin
    case 'consultarProyectoAdmin':

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $proyecto = new Proyecto("","","","","","","");
        $CodigoProy = $_REQUEST['CodigoProy'];
        $consultaP = $proyecto->ConsultarProyecto($CodigoProy);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaP)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarProyecto"] = $consulta;

        require_once "View/Proyecto/modificarProyectoAdmin.php";

        break;

//Modificar un proyecto
    case 'modificarProyecto':

        $tipou=$_SESSION["TipoUsuario"];

        $CodigoProy = $_POST['CodigoProy'];
        $TipoParticipacionProy = $_POST['TipoParticipacionProy'];
        $TituloProy = $_POST['TituloProy'];
        $EntidadFinanciadora = $_POST['EntidadFinanciadora'];
        $AcronimoProy = $_POST['AcronimoProy'];
        $AnhoInicioProy = $_POST['AnhoInicioProy'];
        $AnhoFinProy = $_POST['AnhoFinProy'];
        $Importe = $_POST['Importe'];
        $Login = $_POST['LoginU'];
        $Proyecto = new Proyecto( $CodigoProy,$TituloProy, $EntidadFinanciadora ,$AcronimoProy ,$AnhoInicioProy,$AnhoFinProy,$Importe );
        $errores  = $Proyecto->validarProyecto($_POST);
          if(!empty($errores)) {
              $msgError = "Los campos con el borde rojo son obligatorios.";
              $consultaProy = $Proyecto->ConsultarProyecto($CodigoProy);
              $consulta = array();
              while ($row1 = mysqli_fetch_array($consultaProy)) {
                  array_push($consulta, $row1);
              }
              $_SESSION["consultarProyecto"] = $consulta;

              if ($tipou == 'U') {
                  require_once "View/Proyecto/modificarProyecto.php";
              } else {
                  require_once "View/Proyecto/modificarProyectoAdmin.php";
              }
          }
         else{

        $Proyecto->ModificarProyecto($CodigoProy,$TipoParticipacionProy);

        $tipou=$_SESSION["TipoUsuario"];
        $loginU = $_POST['LoginU'];
        if($tipou == 'U'){

            header("Location: index.php?controlador=Proyectos&evento=listarProyectos&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Proyectos&evento=listarProyectosAdmin");
        }
        }

        break;

//Listar Proyectos por usuario
    case 'listarProyectos':

        $Login = $_REQUEST['LoginU'];
        $lista = new Proyecto("","","","","","","");

        //todos los Proyecto
        $listaProyectos= $lista->ListarProyectos($Login);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaProyectos)){
            array_push($listaResultado, $row);
        }
        //Proyectos como investigador
        $listaProyectosInvestigador = $lista->ListarProyectosInvestigador($Login);
        $listaResultadoInvestigador = array();
        while($row1 = mysqli_fetch_array($listaProyectosInvestigador)){
            array_push($listaResultadoInvestigador, $row1);
        }

        //Proyectos como investigador principal
        $listaProyectosInvestigadorPrin = $lista->ListarProyectosInvestigadorPrincipal($Login);
        $listaResultadoInvesPrin = array();
        while($row2 = mysqli_fetch_array($listaProyectosInvestigadorPrin)){
            array_push($listaResultadoInvesPrin, $row2);
        }

        $_SESSION["listarProyectos"] = $listaResultado;
        $_SESSION["listarProyectosInvestigador"] = $listaResultadoInvestigador;
        $_SESSION["listarProyectosInvestigadorPrincipal"] = $listaResultadoInvesPrin;

        require_once("View/Proyecto/listarProyectos.php");

        break;

///Listar proyectos nivel administrador
    case 'listarProyectosAdmin':

        $lista = new Proyecto("","","","","","","");

        //todos los Proyecto Admin
        $listaProyectosAdmin= $lista->ListarProyectosAdmin();
        $listaResultadoAdmin = array();
        while($row = mysqli_fetch_array($listaProyectosAdmin)){
            array_push($listaResultadoAdmin, $row);
        }
        //Proyectos como investigador Admin
        $listaProyectosInvestigadorAdmin = $lista->ListarProyectosInvestigadorAdmin();
        $listaResultadoInvestigadorAdmin = array();
        while($row1 = mysqli_fetch_array($listaProyectosInvestigadorAdmin)){
            array_push($listaResultadoInvestigadorAdmin, $row1);
        }

        //Proyectos como investigador principal Admin
        $listaProyectosInvestigadorPrinAdmin = $lista->ListarProyectosInvestigadorPrincipalAdmin();
        $listaResultadoInvesPrinAdmin = array();
        while($row2 = mysqli_fetch_array($listaProyectosInvestigadorPrinAdmin)){
            array_push($listaResultadoInvesPrinAdmin, $row2);
        }

        $_SESSION["listarProyectosAdmin"] = $listaResultadoAdmin;
        $_SESSION["listarProyectosInvestigadorAdmin"] = $listaResultadoInvestigadorAdmin;
        $_SESSION["listarProyectosInvestigadorPrincipalAdmin"] = $listaResultadoInvesPrinAdmin;

        require_once("View/Proyecto/listarProyectosAdmin.php");

        break;

//Buscar Proyecto
    case 'buscarProyecto':
        $buscar= $_POST['textoBusqueda'];

        $Proyecto = new Proyecto("","","","","","","");
        $consultarProyecto = $Proyecto->BuscarProyecto($buscar);

        if(!empty($consultarProyecto)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarProyecto)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Proyecto/buscarProyecto.php";
            }else{
                require_once "View/Proyecto/BuscarProyectoAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

//Borrar proyecto
    case 'borrarProyecto':
        $CodigoProy=$_REQUEST["CodigoProy"];
        $Login=$_REQUEST["LoginU"];
        $Proyecto = new Proyecto("","","","","","","");
        $Proyecto->BorrarParticipa($Login,$CodigoProy);
        $Proyecto->BorrarProyecto($CodigoProy);

        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Proyectos&evento=listarProyectos&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Proyectos&evento=listarProyectosAdmin");
        }
        break;




    default:

        echo "ACCION NO REGISTRADA";
        break;
}

?>

