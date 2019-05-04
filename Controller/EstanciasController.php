<?php
// Controlador de Proyectos Dirigidos
require_once 'Controller/ControllerController.php';
require_once 'Model/Estancias.php';
$evento = $_REQUEST['evento'];

switch ($evento) {


    // Página insertar estancia
    case "paginaInsertarEstancia":
        require_once "View/Estancia/insertarEstancia.php";
        break;

    // Página insertar estancia admin
    case "paginaInsertarEstanciaAdmin":
        require_once "View/Estancia/insertarEstanciaAdmin.php";
        break;

    case 'altaEstancia':
        $loginU=$_POST["LoginU"];
        $estancia = new Estancias($_POST["CodigoE"],$_POST["CentroE"],$_POST["UniversidadE"],$_POST["PaisE"],$_POST["FechaInicioE"],$_POST["FechaFinE"],$_POST["TipoE"],$_POST["LoginU"]);
        $estancia->AltaEstancia();
        header("Location: index.php?controlador=Estancias&evento=listarEstancias&LoginU=$loginU");

    break;

    case 'altaEstanciaAdmin':

        $estancia = new Estancias($_POST["CodigoE"],$_POST["CentroE"],$_POST["UniversidadE"],$_POST["PaisE"],$_POST["FechaInicioE"],$_POST["FechaFinE"],$_POST["TipoE"],$_POST["Login"]);
        $estancia->AltaEstancia();
        header("Location: index.php?controlador=Estancias&evento=listarEstanciasAdmin");
        break;

    case 'consultarEstancia':

        $estancia = new Estancias("","","","","","","","");
        $CodigoE = $_REQUEST['CodigoE'];
        $consultaE = $estancia->ConsultarEstancia($CodigoE);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaE)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarEstancia"] = $consulta;

        require_once "View/Estancia/modificarEstancia.php";

        break;

    case 'modificarEstancia':

        $CodigoE = $_POST['CodigoE'];
        $CentroE = $_POST['CentroE'];
        $UniversidadE = $_POST['UniversidadE'];
        $PaisE = $_POST['PaisE'];
        $FechaInicioE= $_POST['FechaInicioE'];
        $FechaFinE = $_POST['FechaFinE'];
        $TipoE = $_POST['TipoE'];
        $LoginU = $_POST['LoginU'];

        $estancia = new Estancias($CodigoE, $CentroE, $UniversidadE, $PaisE, $FechaInicioE, $FechaFinE, $TipoE, $LoginU );
        $errores    = $estancia->validarEstancia($_POST);
        if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Estancia/modificarEstancia.php";
        }
        else{
            $estancia->ModificarEstancia($CodigoE);
            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Estancias&evento=listarEstancias&LoginU=$loginU");
            }else{
                header("Location: index.php?controlador=Estancias&evento=listarEstanciasAdmin");
            }
        }

    break;

//listar estancias de usuario
    case 'listarEstancias':
        $LoginU = $_REQUEST['LoginU'];
        $lista = new Estancias("","","","","","","","");
        //todas las estancias
        $listaEstancias = $lista->ListarEstancias($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaEstancias)){
            array_push($listaResultado, $row);
        }
        //estancias de investigacion
        $listaEstanciasInves = $lista->ListarEstanciasInvertigacion($LoginU);
        $listaResultadoEInves = array();
        while($row1 = mysqli_fetch_array($listaEstanciasInves)){
            array_push($listaResultadoEInves, $row1);
        }
        //estancias de doctorado
        $listaEstanciasD = $lista->ListarEstanciasDoctorado($LoginU);
        $listaResultadoED = array();
        while($row2 = mysqli_fetch_array($listaEstanciasD)){
            array_push($listaResultadoED, $row2);
        }
        //estancias de invitado
        $listaEstanciasInvi = $lista->ListarEstanciasInvitado($LoginU);
        $listaResultadoEInvi = array();
        while($row3 = mysqli_fetch_array($listaEstanciasInvi)){
            array_push($listaResultadoEInvi, $row3);
        }

        $_SESSION["listarEstancias"] = $listaResultado;
        $_SESSION["listarEstanciasInvestigacion"] = $listaResultadoEInves;
        $_SESSION["listarEstanciasDoctorado"] = $listaResultadoED;
        $_SESSION["listarEstanciasInvitado"] = $listaResultadoEInvi;
        require_once("View/Estancia/listarEstancias.php");

    break;

//listar todas las estancias como admin
    case 'listarEstanciasAdmin':

        $lista = new Estancias("","","","","","","","");

        //todas las estancias
        $listaEstancias = $lista->ListarEstanciasAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaEstancias)){
            array_push($listaResultado, $row);
        }
        //estancias de investigacion
        $listaEstanciasInves = $lista->ListarEstanciasInvertigacionAdmin();
        $listaResultadoEInves = array();
        while($row1 = mysqli_fetch_array($listaEstanciasInves)){
            array_push($listaResultadoEInves, $row1);
        }
        //estancias de doctorado
        $listaEstanciasD = $lista->ListarEstanciasDoctoradoAdmin();
        $listaResultadoED = array();
        while($row2 = mysqli_fetch_array($listaEstanciasD)){
            array_push($listaResultadoED, $row2);
        }
        //estancias de invitado
        $listaEstanciasInvi = $lista->ListarEstanciasInvitadoAdmin();
        $listaResultadoEInvi = array();
        while($row3 = mysqli_fetch_array($listaEstanciasInvi)){
            array_push($listaResultadoEInvi, $row3);
        }

        $_SESSION["listarEstanciasAdmin"] = $listaResultado;
        $_SESSION["listarEstanciasInvestigacionAdmin"] = $listaResultadoEInves;
        $_SESSION["listarEstanciasDoctoradoAdmin"] = $listaResultadoED;
        $_SESSION["listarEstanciasInvitadoAdmin"] = $listaResultadoEInvi;

        require_once("View/Estancia/listarEstanciasAdmin.php");

        break;

//borrar estancia
    case 'borrarEstancia':
        $CodigoE=$_REQUEST["CodigoE"];
        $Estancia = new Estancias("","","","","","","","");

        $Estancia->BorrarEstancia($CodigoE);

        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Estancias&evento=listarEstancias&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Estancias&evento=listarEstanciasAdmin");
        }
        break;

//buscar estancia
    case 'buscarEstancia':
        $buscar= $_POST['textoBusqueda'];

        $Estancia = new Estancias("","","","","","","","");
        $consultarEstancia = $Estancia->BuscarEstancia($buscar);

        if(!empty($consultarEstancia)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarEstancia)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Estancia/buscarEstancias.php";
            }else{
                require_once "View/Estancia/buscarEstanciasAdmin.php";
            }


        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;



    default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
