<?php
// Controlador de Proyectos Dirigidos
require_once 'Controller/ControllerController.php';
require_once 'Model/ProyectosDirigidos.php';
require_once 'Model/Usuarios.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

// Página insertar proyecto dirigido
    case "paginaInsertarProyectoDirigido":
        require_once "View/ProyectoDirigido/insertarProyectoDirigido.php";
        break;

// Página insertar proyecto dirigido admin
    case "paginaInsertarProyectoDirigidoAdmin":

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        require_once "View/ProyectoDirigido/insertarProyectoDirigidoAdmin.php";
        break;
		
//modificado alta proyectos dirigidos
//alta proyectos dirigidos
    case 'altaProyectoDirigido':      
        
        //recoge los datos del proyecto dirigido
        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $CodigoPD = $_REQUEST['CodigoPD'];
        $login=$_REQUEST["LoginU"];

        
        $errores = $proyectoDirigido->validarProyectoDirigido($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/ProyectoDirigido/insertarProyectoDirigido.php";
        }
        else{

            $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoPD);

            if($consultaPD->num_rows > 0){    // Existe proyecto dirigido
                $errores = array("CodigoPD", "TituloPD", "AlumnoPD", "FechaLecturaPD", "CalificacionPD", "URLPD", "CotutorPD", "TipoPD");
                $msgError = "El proyecto dirigido: " . $_POST["CodigoPD"] . " ya existe, no puede insertar el mismo.";
                require_once "View/ProyectoDirigido/insertarProyectoDirigido.php";
            }else{
                $proyectoDirigido->AltaProyectoDirigido();
                $proyectoDirigido->Dirige($login, $CodigoPD);
                header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=".$login);
            }

        }

        break;
	
//alta proyecto dirigido modificado	
//Alta proyecto dirigido admin
    case 'altaProyectoDirigidoAdmin':
         //recoge los datos del proyecto dirigido
        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"]);
        $CodigoPD = $_REQUEST['CodigoPD'];
        $login=$_REQUEST["LoginU"];

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $errores = $proyectoDirigido->validarProyectoDirigido($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/ProyectoDirigido/insertarProyectoDirigidoAdmin.php";
        }
        else{

            $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoPD);

            if($consultaPD->num_rows > 0){    // Existe proyecto dirigido

                $errores = array("LoginU", "CodigoPD", "TituloPD", "AlumnoPD", "FechaLecturaPD", "CalificacionPD", "URLPD", "CotutorPD", "TipoPD");
                $msgError = "El proyecto dirigido: " . $_POST["CodigoPD"] . " ya existe, no puede insertar el mismo.";
                require_once "View/ProyectoDirigido/insertarProyectoDirigidoAdmin.php";

            }else{
                $proyectoDirigido->AltaProyectoDirigido();
                $proyectoDirigido->Dirige($login,$CodigoPD);
                header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
            }

        }

    break;
		
//Consultar proyectos dirigidos para modificar
    case 'consultarProyectoDirigido':
        $tipou=$_SESSION["TipoUsuario"];
        $proyectoDirigido = new ProyectosDirigidos("","","","","","","","");
        $CodigoP = $_REQUEST['CodigoPD'];
        $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoP);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaPD)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarProyectoDirigido"] = $consulta;

        if($tipou == 'U'){
            require_once "View/ProyectoDirigido/modificarProyectoDirigido.php";
        }
        else{

            $Usuario = new Usuarios("","","","","","","","","");
            $consultarUsuarios = $Usuario->ListarUsuarios();
            $consulta = array();
            while($row = mysqli_fetch_array($consultarUsuarios)){
                array_push($consulta, $row);
            }
            $_SESSION["listarUsuarios"] = $consulta;

            require_once "View/ProyectoDirigido/modificarProyectoDirigidoAdmin.php";

        }

    break;


//Modificar proyectos dirigidos
    case 'modificarProyectosDirigidos':

        $tipou=$_SESSION["TipoUsuario"];
        $Login=$_REQUEST["LoginU"];
        $LoginAnt=$_REQUEST["LoginU_ant"];
        $CodigoPD = $_POST['CodigoPD'];
        $TituloPD = $_POST['TituloPD'];
        $AlumnoPD = $_POST['AlumnoPD'];
        $FechaLecturaPD = $_POST['FechaLecturaPD'];
        $CalificacionPD = $_POST['CalificacionPD'];
        $URLPD = $_POST['URLPD'];
        $CotutorPD = $_POST['CotutorPD'];
        $TipoPD = $_POST['TipoPD'];

        $proyectoDirigido = new ProyectosDirigidos($CodigoPD, $TituloPD, $AlumnoPD, $FechaLecturaPD, $CalificacionPD, $URLPD, $CotutorPD, $TipoPD );
        $errores = $proyectoDirigido->validarProyectoDirigido($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            $consultaPD = $proyectoDirigido->ConsultarProyectoDirigido($CodigoPD);
            $consulta = array();
            while($row1 = mysqli_fetch_array($consultaPD)){
                array_push($consulta, $row1);
            }
            $_SESSION["consultarProyectoDirigido"] = $consulta;

            if($tipou == 'U') {
                require_once "View/ProyectoDirigido/modificarProyectoDirigido.php";
            }else{

                $Usuario = new Usuarios("","","","","","","","","");
                $consultarUsuarios = $Usuario->ListarUsuarios();
                $consulta = array();
                while($row = mysqli_fetch_array($consultarUsuarios)){
                    array_push($consulta, $row);
                }
                $_SESSION["listarUsuarios"] = $consulta;

                require_once "View/ProyectoDirigido/modificarProyectoDirigidoAdmin.php";
            }
        }
        else{ 

            $proyectoDirigido->ModificarProyectoDirigido($CodigoPD);
            $proyectoDirigido->BorrarDirige($LoginAnt, $CodigoPD);
            $proyectoDirigido->Dirige($Login,$CodigoPD);

            if($tipou == 'U'){
                header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=$Login");
            }else{
                header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
            }
        }

    break;

//Listar proyectos dirigidos
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

 // Listar proyecto dirigido admin
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

//Borrar un proyecto dirigido
    case'borrarProyectoDirigido':
        $LoginU=$_REQUEST["LoginU"];
        $CodigoPD=$_REQUEST["CodigoPD"];
        $ProyectoDirigido = new ProyectosDirigidos("","","","","","","","");
        $ProyectoDirigido->BorrarDirige($LoginU, $CodigoPD);
        $ProyectoDirigido->BorrarProyectoDirigido($CodigoPD);
        $tipou=$_SESSION["TipoUsuario"];
        if($tipou == 'U'){
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
        }
        break;

//Buscar proyectos dirigidos
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
