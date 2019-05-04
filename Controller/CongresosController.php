<?php
// Controlador de congresos

require_once 'Model/Congreso.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    // Página insertar congreso
    case "paginaInsertarCongreso":
        require_once "View/Congreso/insertarCongreso.php";
        break;
    // Página insertar congreso admin
    case "paginaInsertarCongresoAdmin":
        require_once "View/Congreso/insertarCongresoAdmin.php";
        break;
    case 'altaCongreso':
        $Login=$_REQUEST["LoginU"];
        $CodigoC = $_REQUEST['CodigoC'];
        $TipoParticipacionC= $_REQUEST['TipoParticipacionC'];
        $congreso = new Congreso($_POST["CodigoC"],$_POST["NombreC"],$_POST["AcronimoC"],$_POST["AnhoC"],$_POST["LugarC"]);
        $p=new Congreso("","","","","");
        $congreso->AltaCongreso();
        $p->Participa($Login,$CodigoC,$TipoParticipacionC);
        $tipou=$_SESSION["TipoUsuario"];
        if($tipou == 'U') {
            header("Location: index.php?controlador=Congresos&evento=listarCongresos&LoginU=$Login");
        }else{
            header("Location: index.php?controlador=Congresos&evento=listarCongresosAdmin");
        }
    break;




    case 'consultarCongreso':

        $congreso = new Congreso("","","","","");
        $CodigoC = $_REQUEST['CodigoC'];
        $consultaC = $congreso->ConsultarCongreso($CodigoC);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaC)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarCongreso"] = $consulta;

        require_once "View/Congreso/modificarCongreso.php";

        break;

    case 'modificarCongreso':

        $CodigoC = $_POST['CodigoC'];
        $TipoParticipacionC = $_POST['TipoParticipacionC'];
        $NombreC = $_POST['NombreC'];
        $AcronimoC = $_POST['AcronimoC'];
        $AnhoC = $_POST['AnhoC'];
        $LugarC = $_POST['LugarC'];
        $Login = $_POST['Login'];


        $congreso = new Congreso( $CodigoC,$NombreC, $AcronimoC ,$AnhoC ,$LugarC );
      //  $errores    = $congreso->validarCongreso($_POST);
      //  if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
        //    require_once "View/Congreso/modificarCongreso.php";
        //   }
      //  else{
            
            $congreso->ModificarCongreso($CodigoC,$TipoParticipacionC);

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Congresos&evento=listarCongresos&LoginU=$loginU");
            }else{
                header("Location: index.php?controlador=Congresos&evento=listarCongresosAdmin");
            }
      //  }

        break;

//listar congresos por usuario
    case 'listarCongresos':

        $LoginU = $_REQUEST['LoginU'];
        $lista = new Congreso("","","","","");

        //todos los congresos
        $listaCongresos= $lista->ListarCongresos($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaCongresos)){
            array_push($listaResultado, $row);
        }
        //congresos MCO
        $listaCongresosMCO = $lista->ListarCongresosMCO($LoginU);
        $listaResultadoMCO = array();
        while($row1 = mysqli_fetch_array($listaCongresosMCO)){
            array_push($listaResultadoMCO, $row1);
        }

        //congresos MCC
        $listaCongresosMCC = $lista->ListarCongresosMCC($LoginU);
        $listaResultadoMCC = array();
        while($row2 = mysqli_fetch_array($listaCongresosMCC)){
            array_push($listaResultadoMCC, $row2);
        }
        //congresos R
        $listaCongresosR = $lista->ListarCongresosR($LoginU);
        $listaResultadoR = array();
        while($row3 = mysqli_fetch_array($listaCongresosR)){
            array_push($listaResultadoR, $row3);
        }
        //congresos C
        $listaCongresosC = $lista->ListarCongresosC($LoginU);
        $listaResultadoC = array();
        while($row4 = mysqli_fetch_array($listaCongresosC)){
            array_push($listaResultadoC, $row4);
        }
        //congresos PCO
        $listaCongresosPCO = $lista->ListarCongresosPCO($LoginU);
        $listaResultadoPCO = array();
        while($row5 = mysqli_fetch_array($listaCongresosPCO)){
            array_push($listaResultadoPCO, $row5);
        }
        //congresos PCC
        $listaCongresosPCC = $lista->ListarCongresosPCC($LoginU);
        $listaResultadoPCC = array();
        while($row6 = mysqli_fetch_array($listaCongresosPCC)){
            array_push($listaResultadoPCC, $row6);
        }
        $_SESSION["listarCongresos"] = $listaResultado;
        $_SESSION["listarCongresosMCO"] = $listaResultadoMCO;
        $_SESSION["listarCongresosMCC"] = $listaResultadoMCC;
        $_SESSION["listarCongresosR"] = $listaResultadoR;
        $_SESSION["listarCongresosC"] = $listaResultadoC;
        $_SESSION["listarCongresosPCO"] = $listaResultadoPCO;
        $_SESSION["listarCongresosPCC"] = $listaResultadoPCC;

        require_once("View/Congreso/listarCongresos.php");

        break;

///listar congresosa nivel administrador
    case 'listarCongresosAdmin':

        $lista = new Congreso("","","","","");

        //todos los congresos
        $listaCongresos= $lista->ListarCongresosAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaCongresos)){
            array_push($listaResultado, $row);
        }
        //congresos MCO
        $listaCongresosMCO = $lista->ListarCongresosMCOAdmin();
        $listaResultadoMCO = array();
        while($row1 = mysqli_fetch_array($listaCongresosMCO)){
            array_push($listaResultadoMCO, $row1);
        }

        //congresos MCC
        $listaCongresosMCC = $lista->ListarCongresosMCCAdmin();
        $listaResultadoMCC = array();
        while($row2 = mysqli_fetch_array($listaCongresosMCC)){
            array_push($listaResultadoMCC, $row2);
        }
        //congresos R
        $listaCongresosR = $lista->ListarCongresosRAdmin();
        $listaResultadoR = array();
        while($row3 = mysqli_fetch_array($listaCongresosR)){
            array_push($listaResultadoR, $row3);
        }
        //congresos C
        $listaCongresosC = $lista->ListarCongresosCAdmin();
        $listaResultadoC = array();
        while($row4 = mysqli_fetch_array($listaCongresosC)){
            array_push($listaResultadoC, $row4);
        }
        //congresos PCO
        $listaCongresosPCO = $lista->ListarCongresosPCOAdmin();
        $listaResultadoPCO = array();
        while($row5 = mysqli_fetch_array($listaCongresosPCO)){
            array_push($listaResultadoPCO, $row5);
        }
        //congresos PCC
        $listaCongresosPCC = $lista->ListarCongresosPCCAdmin();
        $listaResultadoPCC = array();
        while($row6 = mysqli_fetch_array($listaCongresosPCC)){
            array_push($listaResultadoPCC, $row6);
        }
        $_SESSION["listarCongresosAdmin"] = $listaResultado;
        $_SESSION["listarCongresosMCOAdmin"] = $listaResultadoMCO;
        $_SESSION["listarCongresosMCCAdmin"] = $listaResultadoMCC;
        $_SESSION["listarCongresosRAdmin"] = $listaResultadoR;
        $_SESSION["listarCongresosCAdmin"] = $listaResultadoC;
        $_SESSION["listarCongresosPCOAdmin"] = $listaResultadoPCO;
        $_SESSION["listarCongresosPCCAdmin"] = $listaResultadoPCC;

        require_once("View/Congreso/listarCongresosAdmin.php");

        break;

//buscar congreso
    case 'buscarCongreso':
        $buscar= $_POST['textoBusqueda'];

        $Congreso = new Congreso("","","","","");
        $consultarCongreso = $Congreso->BuscarCongreso($buscar);

        if(!empty($consultarCongreso)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarCongreso)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Congreso/buscarCongreso.php";
            }else{
                require_once "View/Congreso/BuscarCongresoAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

//borrar congreso
    case 'borrarCongreso':
        $CodigoC=$_REQUEST["CodigoC"];
        $Login=$_REQUEST["LoginU"];
        $Congreso = new Congreso("","","","","");
        $participacion->BorrarParticipa($Login,$CodigoC);
        $Congreso->BorrarCongreso($CodigoC);

        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Congreso&evento=listarCongresos&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Congreso&evento=listarCongresosAdmin");
        }
        break;




    default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
