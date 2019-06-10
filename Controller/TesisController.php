<?php
// Controlador de Tad

require_once 'Model/Tesis.php';

require_once 'Model/Usuarios.php';

require_once 'Controller/ControllerController.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

// Página insertar tesis
    case "paginaInsertarTesis":
        require_once "View/Tesis/insertarTesis.php";
        break;

// Página insertar tesis admin
    case "paginaInsertarTesisAdmin":

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        require_once "View/Tesis/insertarTesisAdmin.php";
        break;
		
//modificada alta tesis 
//dar de alta una tesis
    case 'altaTesis':
        $loginU=$_POST["LoginU"];
        $tesis = new Tesis($_POST["CodigoTesis"],$_POST["AutorTesis"],$_POST["FechaInscripcion"],$_POST["FechaLectura"],$_POST["CalificacionTesis"],$_POST["URLTesis"],$_POST["LoginU"]);
        $codigoTesis = $_REQUEST["CodigoTesis"];
		$tesis -> consultarTesis($CodigoTesis);
		if(!isset($tesis)){
			anadirMensaje("| SUCCESS | La tesis: ".$_POST["CodigoTesis"]." ya existe","success");
			header('location: View/Tesis/insertarTesis.php');
		}else{
			$tesis->AltaTesis();
			header("Location: index.php?controlador=Tesis&evento=listarTesis&LoginU=$loginU");
		}       
		
        break;
//fin modificacion Alta tesis 	
	
//modificada alta tesis admin
//dar de alta una tesis como admin
    case 'altaTesisAdmin':

        $tesis = new Tesis($_POST["CodigoTesis"],$_POST["AutorTesis"],$_POST["FechaInscripcion"],$_POST["FechaLectura"],$_POST["CalificacionTesis"],$_POST["URLTesis"],$_POST["Login"]);
        $codigoTesis = $_REQUEST["CodigoTesis"];
		$tesis -> consultarTesis($CodigoTesis);
		if(!isset($tesis)){
			anadirMensaje("| SUCCESS | La tesis: ".$_POST["CodigoTesis"]." ya existe","success");
			header('location: View/Tesis/insertarTesis.php');
		}else{
			$tesis->AltaTesis();
			header("Location: index.php?controlador=Tesis&evento=listarTesisAdmin");
		}
        break;
//fin modificacion Alta tesis admin

//Consulta de una tesis para modificar
   case 'consultarTesis':

        $Tesis = new Tesis("","","","","","","");
        $CodigoTesis = $_REQUEST['CodigoTesis'];
        $consultaT = $Tesis->ConsultarTesis($CodigoTesis);
        $consulta = array();
        while($row = mysqli_fetch_array($consultaT)){
            array_push($consulta, $row);
        }
        $_SESSION["consultarTesis"] = $consulta;

        require_once "View/Tesis/modificarTesis.php";

        break;

//Consulta de una tesis para modificar como admin
    case 'consultarTesisAdmin':

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $Tesis = new Tesis("","","","","","","");
        $CodigoTesis = $_REQUEST['CodigoTesis'];
        $consultaT = $Tesis->ConsultarTesis($CodigoTesis);
        $consulta = array();
        while($row = mysqli_fetch_array($consultaT)){
            array_push($consulta, $row);
        }
        $_SESSION["consultarTesis"] = $consulta;

        require_once "View/Tesis/modificarTesisAdmin.php";

        break;

//Modificar una tesis
    case 'modificarTesis':

        $CodigoTesis = $_POST['CodigoTesis'];
        $AutorTesis = $_POST['AutorTesis'];
        $FechaInscripcion = $_POST['FechaInscripcion'];
        $FechaLectura = $_POST['FechaLectura'];
        $CalificacionTesis = $_POST['CalificacionTesis'];
        $URLTesis = $_POST['URLTesis'];
        $LoginU = $_POST['LoginU'];


        $tesis = new Tesis( $CodigoTesis,$AutorTesis, $FechaInscripcion ,$FechaLectura,$CalificacionTesis,$URLTesis, $LoginU  );
        $errores    = $tesis->validarTesis($_POST);
        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            $consultaT = $tesis->ConsultarTesis($CodigoTesis);
            $consulta = array();
            while($row1 = mysqli_fetch_array($consultaT)){
                array_push($consulta, $row1);
            }
            $_SESSION["consultarTesis"] = $consulta;

            if($tipou == 'U') {
                require_once "View/Tesis/modificarTesis.php";
            }else{
                require_once "View/Tesis/modificarTesisAdmin.php";
            }
        }
        else{

            $tesis->ModificarTesis($CodigoTesis);
            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Tesis&evento=listarTesis&LoginU=$LoginU");
            }else{
                header("Location: index.php?controlador=Tesis&evento=listarTesisAdmin");
            }
        }


        break;

//listar tesis por usuario
    case 'listarTesis':

        $LoginU = $_REQUEST['LoginU'];
        $lista = new Tesis("","","","","","","");

        $listaTesis= $lista->ListarTesis($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTesis)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarTesis"] = $listaResultado;


        require_once("View/Tesis/listarTesis.php");

        break;

//listar todas las tesis como admin
    case 'listarTesisAdmin':

        $lista = new Tesis("","","","","","","");

        $listaTesis= $lista->ListarTesisAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTesis)){
            array_push($listaResultado, $row);
        }

        $_SESSION["listarTesisAdmin"] = $listaResultado;

        require_once("View/Tesis/listarTesisAdmin.php");

        break;

//buscar tesis
    case 'buscarTesis':
        $buscar= $_POST['textoBusqueda'];

        $Tesis = new Tesis("","","","","","","");
        $consultarTesis = $Tesis->BuscarTesis($buscar);

        if(!empty($consultarTesis)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarTesis)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Tesis/buscarTesis.php";
            }else{
                require_once "View/Tesis/BuscarTesisAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

//borrar tesis
    case 'borrarTesis':
        $CodigoTesis=$_REQUEST["CodigoTesis"];
        $Tesis = new Tesis("","","","","","","");


        $Tesis->BorrarTesis($CodigoTesis);


        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Tesis&evento=listarTesis&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Tesis&evento=listarTesisAdmin");
        }
        break;


    default:

        echo "ACCION NO REGISTRADA";
        break;
}

?>

