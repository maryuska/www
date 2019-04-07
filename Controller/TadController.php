<?php
// Controlador de Tad

require_once 'Model/Tad.php';

require_once 'Controller/ControllerController.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    // Página insertar tad
    case "paginaInsertarTad":
        require_once "View/Tad/insertarTad.php";
        break;

    // Página insertar tad admin
    case "paginaInsertarTadAdmin":
        require_once "View/Tad/insertarTadAdmin.php";
        break;

    case 'altaTad':

        $loginU=$_POST["LoginU"];
        $tad = new Tad($_POST["CodigoTAD"],$_POST["TituloTAD"],$_POST["AlumnoTAD"],$_POST["FechaLecturaTAD"],$_POST["LoginU"]);
        $tad->AltaTad();
        header("Location: index.php?controlador=Tad&evento=listarTad&LoginU=$loginU");

    break;

    case 'altaTadAdmin':

        $tad = new Tad($_POST["CodigoTAD"],$_POST["TituloTAD"],$_POST["AlumnoTAD"],$_POST["FechaLecturaTAD"],$_POST["LoginU"]);
        $tad->AltaTad();
        header("Location: index.php?controlador=Tad&evento=listarTadAdmin");

        break;


    case 'consultarTad':

        $Tad = new Tad("","","","","");
        $CodigoTAD = $_REQUEST['CodigoTAD'];
        $consultaT = $Tad->ConsultarTad($CodigoTAD);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaT)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarTad"] = $consulta;

        require_once "View/Tad/modificarTad.php";

        break;

    case 'modificarTad':

        $CodigoTAD = $_POST['CodigoTAD'];
        $TituloTAD = $_POST['TituloTAD'];
        $AlumnoTAD = $_POST['AlumnoTAD'];
        $FechaLecturaTAD = $_POST['FechaLecturaTAD'];
        $LoginU = $_POST['LoginU'];


        $tad = new Tad( $CodigoTAD,$TituloTAD, $AlumnoTAD ,$FechaLecturaTAD, $LoginU  );
        $errores    = $tad->validarTad($_POST);
        if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Tad/modificarTad.php";
        }
        else{

            $tad->ModificarTad($CodigoTAD);
            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Tad&evento=listarTad&LoginU=$LoginU");
            }else{
                header("Location: index.php?controlador=Tad&evento=listarTadAdmin");
            }
        }


        break;

//listar tad por usuario
    case 'listarTad':

        $LoginU = $_REQUEST['LoginU'];
        $lista = new Tad("","","","","");

        $listaTad= $lista->ListarTad($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTad)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarTad"] = $listaResultado;


        require_once("View/Tad/listarTad.php");

        break;

//listar todos los tad admin
    case 'listarTadAdmin':

        $lista = new Tad("","","","","");

        $listaTad= $lista->ListarTadAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTad)){
            array_push($listaResultado, $row);
        }

        $_SESSION["listarTadAdmin"] = $listaResultado;

        require_once("View/Tad/listarTadAdmin.php");

        break;









//buscar materia
    case 'buscarTad':
        $buscar= $_POST['textoBusqueda'];

        $Tad = new Tad("","","","","");
        $consultarTad = $Tad->BuscarTad($buscar);

        if(!empty($consultarTad)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarTad)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Tad/buscarTad.php";
            }else{
                require_once "View/Tad/BuscarTadAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

//borrar materia
    case 'borrarTad':
        $CodigoTAD=$_REQUEST["CodigoTAD"];
        $Tad = new Tad("","","","","");


        $Tad->BorrarTad($CodigoTAD);


        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Tad&evento=listarTad&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Tad&evento=listarTadAdmin");
        }
        break;


    default:

        echo "ACCION NO REGISTRADA";
        break;
}

?>

