<?php
// Controlador de Proyectos Dirigidos

require_once '../Model/ProyectosDirigidos.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    case 'altaProyectoDirigido':

        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $proyectoDirigido->AltaProyectoDirigido();
        header("location: ProyectosDirigidosController.php?evento=listarProyectosDirigidos");

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

        header("location: ProyectosDirigidosController.php?evento=listarProyectosDirigidos");

    break;


    case 'listarProyectosDirigidos':

        $lista = new ProyectosDirigidos("","","","","","","","");
        //todos los proyectos dirigidos
        $listaProyectosDirigidos = $lista->ListarProyectosDirigidos();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaProyectosDirigidos)){
            array_push($listaResultado, $row);
        }



        //proyecto fin de carrera
        $listaProyectosDirigidosPFC = $lista->ListarProyectosDirigidosPFC();
        $listaResultadoPFC = array();
        while($row1 = mysqli_fetch_array($listaProyectosDirigidosPFC)){
            array_push($listaResultadoPFC, $row1);
        }
        //trabajos fin de grado
        $listaProyectosDirigidosTFG = $lista->ListarProyectosDirigidosTFG();
        $listaResultadoTFG = array();
        while($row2 = mysqli_fetch_array($listaProyectosDirigidosTFG)){
            array_push($listaResultadoTFG, $row2);
        }
        //trabajos fin de master
        $listaProyectosDirigidosTFM = $lista->ListarProyectosDirigidosTFM();
        $listaResultadoTFM = array();
        while($row3 = mysqli_fetch_array($listaProyectosDirigidosTFM)){
            array_push($listaResultadoTFM, $row3);
        }

        $_SESSION["listarProyectosDirigidos"] = $listaResultado;
        $_SESSION["listarProyectosDirigidosTFC"] = $listaResultadoPFC;
        $_SESSION["listarProyectosDirigidosTFG"] = $listaResultadoTFG;
        $_SESSION["listarProyectosDirigidosTFM"] = $listaResultadoTFM;
        header("location: ../../View/ProyectoDirigido/listarProyectosDirigidos.php");

    break;







  default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
