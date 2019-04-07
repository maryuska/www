<?php
// Controlador de Tad

require_once 'Model/Tesis.php';

require_once 'Controller/ControllerController.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    // Página insertar tesis
    case "paginaInsertarTesis":
        require_once "View/Tesis/insertarTesis.php";
        break;

    // Página insertar tesis admin
    case "paginaInsertarTesisAdmin":
        require_once "View/Tesis/insertarTesisAdmin.php";
        break;

    case 'altaTesis':

        $loginU=$_POST["LoginU"];
        $tesis = new Tesis($_POST["CodigoTesis"],$_POST["AutorTesis"],$_POST["FechaInscripcion"],$_POST["FechaLectura"],$_POST["CalificacionTesis"],$_POST["URLTesis"],$_POST["LoginU"]);
        $tesis->AltaTesis();
        header("Location: index.php?controlador=Tesis&evento=listarTesis&LoginU=$loginU");

        break;

    case 'altaTesisAdmin':

        $tesis = new Tesis($_POST["CodigoTesis"],$_POST["AutorTesis"],$_POST["FechaInscripcion"],$_POST["FechaLectura"],$_POST["CalificacionTesis"],$_POST["URLTesis"],$_POST["LoginU"]);
        $tesis->AltaTesis();
        header("Location: index.php?controlador=Tesis&evento=listarTesisAdmin");

        break;


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
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Tesis/modificarTesis.php";
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

//listar todos los tesis admin
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

//borrar materia
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

