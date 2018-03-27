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
        while($row1 = mysql_fetch_array($consultaE)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarEstancia"] = $consulta;

        header("location: ../../View/Estancia/modificarEstancia.php");

        break;

    case 'modificarEstancia':

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
