<?php
// Controlador de Proyectos Dirigidos

require_once '../Model/ProyectosDirigidos.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    case 'altaProyectoDirigido':
        $Login=$_REQUEST["LoginU"];
        $CodigoPD = $_REQUEST['CodigoPD'];
        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $p=new ProyectosDirigidos("","","","","","","","");
        $proyectoDirigido->AltaProyectoDirigido();
        $p->Dirige($Login,$CodigoPD);
        $tipou=$_SESSION["TipoUsuario"];
        if($tipou == 'U') {
            header("location: ProyectosDirigidosController.php?evento=listarProyectosDirigidos&LoginU=$Login");
        }else{
            header("location: ProyectosDirigidosController.php?evento=listarProyectosDirigidos");

        }
    break;



    case 'consultarProyectoDirigido':

        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $CodigoP = $_REQUEST['CodigoPD'];
        $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoP);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaPD)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarProyectoDirigido"] = $consulta;

        header("location: ../../View/ProyectoDirigido/modificarProyectoDirigido.php");

        break;

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

        header("location: ProyectosDirigidosController.php?evento=listarProyectosDirigidos&LoginU=$Login");

    break;


    case 'listarProyectosDirigidos':
        $tipou=$_SESSION["TipoUsuario"];
        if($tipou == 'U') {
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
            header("location: ../../View/ProyectoDirigido/listarProyectosDirigidos.php");

        }else {
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
            header("location: ../../View/ProyectoDirigido/listarProyectosDirigidosAdmin.php");
        }
    break;



    //consultar detalle del proyecto dirigido
    case 'consultarDetalleProyectoDirigido':

        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $CodigoP = $_REQUEST['CodigoPD'];
        $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoP);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaPD)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarProyectoDirigido"] = $consulta;

        header("location: ../../View/ProyectoDirigido/consultarDetalle.php");
        break;


//confirmar borrado de proyecto dirigido
    case 'confirmarBorrado':

        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $CodigoP = $_REQUEST['CodigoPD'];
        $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoP);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaPD)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarProyectoDirigido"] = $consulta;

        header("location: ../../View/ProyectoDirigido/confirmarBorrarPD.php");
        break;



//borrar un proyecto dirigido
    case'borrarProyectoDirigido':
        $LoginU=$_REQUEST["LoginU"];
        $CodigoPD=$_REQUEST["CodigoPD"];
        $ProyectoDirigido = new ProyectosDirigidos("","","","","","","","");
        $ProyectoDirigido ->BorrarDirige($LoginU, $CodigoPD);
        $ProyectoDirigido->BorrarProyectoDirigido($CodigoPD);
        header("location: ../../Controller/ProyectosDirigidosController.php?evento=listarProyectosDirigidos&LoginU=$LoginU");

        break;


//buscar proyectos dirigidos
    case 'buscarProyectoDirigido';
        $buscar= $_POST['textoBusqueda'];

        $ProyectoDirigido = new ProyectosDirigidos("","","","","","","","");
        $consultarProyecDirigido = $ProyectoDirigido->BuscarProyectoDirigido($buscar);

        if(!empty($consultarProyecDirigido)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarProyecDirigido)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusquedaPD"] = $listaResultado;

            header("location: ../../View/ProyectoDirigido/buscarProyectoDirigido.php");
        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;




  default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
