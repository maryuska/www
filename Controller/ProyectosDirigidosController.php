<?php
// Controlador de Proyectos Dirigidos

require_once '../Model/ProyectosDirigidos.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    case 'altaProyectoDirigido':

        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $proyectoDirigido->AltaProyectoDirigido();

        header("location: ProyectosDirigidosController.php?evento=listarProyectosDirigidos");
        //header("location: ../View/home.php");


    break;


    case 'modificarProyectosDirigidos':


    break;



    case 'listarProyectosDirigidos':
        $lista = new ProyectosDirigidos("","","","","","","","");
        //todos los proyectos dirigidos
        $listaProyectosDirigidos = $lista->ListarProyectosDirigidos();
        $listaResultado = array();
        while($row = mysql_fetch_array($listaProyectosDirigidos)){
            array_push($listaResultado, $row);
        }



        //proyecto fin de carrera
        $listaProyectosDirigidosPFC = $lista->ListarProyectosDirigidosPFC();
        $listaResultadoPFC = array();
        while($row1 = mysql_fetch_array($listaProyectosDirigidosPFC)){
            array_push($listaResultadoPFC, $row1);
        }
        //trabajos fin de grado
        $listaProyectosDirigidosTFG = $lista->ListarProyectosDirigidosTFG();
        $listaResultadoTFG = array();
        while($row2 = mysql_fetch_array($listaProyectosDirigidosTFG)){
            array_push($listaResultadoTFG, $row2);
        }
        //trabajos fin de master
        $listaProyectosDirigidosTFM = $lista->ListarProyectosDirigidosTFM();
        $listaResultadoTFM = array();
        while($row3 = mysql_fetch_array($listaProyectosDirigidosTFM)){
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
