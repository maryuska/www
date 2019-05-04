<?php
// Controlador de Proyectos Dirigidos
require_once 'Controller/ControllerController.php';
require_once 'Model/ProyectosDirigidos.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

// Página insertar proyecto dirigido
    case "paginaInsertarProyectoDirigido":
        require_once "View/ProyectoDirigido/insertarProyectoDirigido.php";
        break;

// Página insertar proyecto dirigido admin
    case "paginaInsertarProyectoDirigidoAdmin":
        require_once "View/ProyectoDirigido/insertarProyectoDirigidoAdmin.php";
        break;

//alta proyectos dirigidos
    case 'altaProyectoDirigido':
        $Login=$_REQUEST["LoginU"];
        $CodigoPD = $_REQUEST['CodigoPD'];
        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $p=new ProyectosDirigidos("","","","","","","","");
        $proyectoDirigido->AltaProyectoDirigido();
        $p->Dirige($Login,$CodigoPD);
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=$loginU");
    break;

//alta proyecto dirigido admin
    case 'altaProyectoDirigidoAdmin':
        $Login = $_REQUEST['Login'];
        $CodigoPD = $_REQUEST['CodigoPD'];
        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $p=new ProyectosDirigidos("","","","","","","","");
        $proyectoDirigido->AltaProyectoDirigido();
        $p->Dirige($Login,$CodigoPD);
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
        break;
//consultar proyectos dirigidos
    case 'consultarProyectoDirigido':

        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $CodigoP = $_REQUEST['CodigoPD'];
        $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoP);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaPD)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarProyectoDirigido"] = $consulta;

        require_once "View/ProyectosDirigidos/modificarProyectoDirigido.php";
        break;

//modificar proyectos dirigidos
    case 'modificarProyectosDirigidos':
        $Login=$_REQUEST["LoginU"];
        $CodigoPD = $_POST['CodigoPD'];
        $TituloPD = $_POST['TituloPD'];
        $AlumnoPD = $_POST['AlumnoPD'];
        $FechaLecturaPD = $_POST['FechaLecturaPD'];
        $CalificacionPD = $_POST['CalificacionPD'];
        $URLPD = $_POST['URLPD'];
        $CotutorPD = $_POST['CotutorPD'];
        $TipoPD = $_POST['TipoPD'];


        $proyectoDirigido = new ProyectosDirigidos($CodigoPD, $TituloPD, $AlumnoPD, $FechaLecturaPD, $CalificacionPD, $URLPD, $CotutorPD, $TipoPD );
        $proyectoDirigido->ModificarProyectoDirigido($CodigoPD);
            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U') {
                header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=$LoginU");
            }else{
                header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
            }

    break;

//listar proyectos dirigidos
    case 'listarProyectosDirigidos':
            $Login=$_REQUEST["LoginU"];
            $lista = new ProyectosDirigidos("","","","","","","","");
            //todos los proyectos dirigidos
            $listaProyectosDirigidos = $lista->ListarProyectosDirigidos($Login);
            $listaResultado = array();
            while($row = mysqli_fetch_array($listaProyectosDirigidos)){
                array_push($listaResultado, $row);
            }
            //proyecto fin de carrera
            $listaProyectosDirigidosPFC = $lista->ListarProyectosDirigidosPFC($Login);
            $listaResultadoPFC = array();
            while($row1 = mysqli_fetch_array($listaProyectosDirigidosPFC)){
                array_push($listaResultadoPFC, $row1);
            }
            //trabajos fin de grado
            $listaProyectosDirigidosTFG = $lista->ListarProyectosDirigidosTFG($Login);
            $listaResultadoTFG = array();
            while($row2 = mysqli_fetch_array($listaProyectosDirigidosTFG)){
                array_push($listaResultadoTFG, $row2);
            }
            //trabajos fin de master
            $listaProyectosDirigidosTFM = $lista->ListarProyectosDirigidosTFM($Login);
            $listaResultadoTFM = array();
            while($row3 = mysqli_fetch_array($listaProyectosDirigidosTFM)){
                array_push($listaResultadoTFM, $row3);
            }

            $_SESSION["listarProyectosDirigidos"] = $listaResultado;
            $_SESSION["listarProyectosDirigidosTFC"] = $listaResultadoPFC;
            $_SESSION["listarProyectosDirigidosTFG"] = $listaResultadoTFG;
            $_SESSION["listarProyectosDirigidosTFM"] = $listaResultadoTFM;
            require_once("View/ProyectoDirigido/listarProyectosDirigidos.php");
    break;

 // listar proyecto dirigido admin
    case 'listarProyectosDirigidosAdmin':
        $lista = new ProyectosDirigidos("", "", "", "", "", "", "", "");
        //todos los proyectos dirigidos
        $listaProyectosDirigidos = $lista->ListarProyectosDirigidosAdmin();
        $listaResultado = array();
        while ($row = mysqli_fetch_array($listaProyectosDirigidos)) {
            array_push($listaResultado, $row);
        }

        //proyecto fin de carrera
        $listaProyectosDirigidosPFC = $lista->ListarProyectosDirigidosPFCAdmin();
        $listaResultadoPFC = array();
        while ($row1 = mysqli_fetch_array($listaProyectosDirigidosPFC)) {
            array_push($listaResultadoPFC, $row1);
        }
        //trabajos fin de grado
        $listaProyectosDirigidosTFG = $lista->ListarProyectosDirigidosTFGAdmin();
        $listaResultadoTFG = array();
        while ($row2 = mysqli_fetch_array($listaProyectosDirigidosTFG)) {
            array_push($listaResultadoTFG, $row2);
        }
        //trabajos fin de master
        $listaProyectosDirigidosTFM = $lista->ListarProyectosDirigidosTFMAdmin();
        $listaResultadoTFM = array();
        while ($row3 = mysqli_fetch_array($listaProyectosDirigidosTFM)) {
            array_push($listaResultadoTFM, $row3);
        }

        $_SESSION["listarProyectosDirigidosAdmin"] = $listaResultado;
        $_SESSION["listarProyectosDirigidosTFCAdmin"] = $listaResultadoPFC;
        $_SESSION["listarProyectosDirigidosTFGAdmin"] = $listaResultadoTFG;
        $_SESSION["listarProyectosDirigidosTFMAdmin"] = $listaResultadoTFM;
        require_once("View/ProyectoDirigido/listarProyectosDirigidosAdmin.php");
        break;

//borrar un proyecto dirigido
    case'borrarProyectoDirigido':
        $LoginU=$_REQUEST["LoginU"];
        $CodigoPD=$_REQUEST["CodigoPD"];
        $ProyectoDirigido = new ProyectosDirigidos("","","","","","","","");
        $ProyectoDirigido ->BorrarDirige($LoginU, $CodigoPD);
        $ProyectoDirigido->BorrarProyectoDirigido($CodigoPD);
            $tipou=$_SESSION["TipoUsuario"];
        if($tipou == 'U'){
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
        }
        break;

//buscar proyectos dirigidos
    case 'buscarProyectoDirigido':
        $buscar= $_POST['textoBusqueda'];

        $ProyectoDirigido = new ProyectosDirigidos("","","","","","","","");
        $consultarProyecDirigido = $ProyectoDirigido->BuscarProyectoDirigido($buscar);

        if(!empty($consultarProyecDirigido)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarProyecDirigido)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

                $tipou=$_SESSION["TipoUsuario"];
                if($tipou == 'U'){
                require_once "View/ProyectoDirigido/buscarProyectoDirigido.php";
                }else{


                require_once "View/ProyectoDirigido/buscarProyectoDirigidoAdmin.php";
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
