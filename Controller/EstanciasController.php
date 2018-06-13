<?php
// Controlador de Proyectos Dirigidos

require_once '../Model/Estancias.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    case 'altaEstancia':
        $loginU=$_POST["LoginU"];
        $estancia = new Estancias($_POST["CodigoE"],$_POST["CentroE"],$_POST["UniversidadE"],$_POST["PaisE"],$_POST["FechaInicioE"],$_POST["FechaFinE"],$_POST["TipoE"],$_POST["LoginU"]);
        $estancia->AltaEstancia();
        header("location:EstanciasController.php?evento=listarEstancias&LoginU=$loginU");

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

        header("location: ../../View/Estancia/modificarEstancia.php");

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
        $estancia->ModificarEstancia($CodigoE);

        header("location: EstanciasController.php?evento=listarEstancias&LoginU=$loginU");

    break;


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
        header("location: ../../View/Estancia/listarEstancias.php");

    break;







  default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
