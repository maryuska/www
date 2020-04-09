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

//Alta proyectos dirigidos
    case 'altaProyectoDirigido':

        // Subimos el fichero si viene alguno
        $AdjuntoPD = '';
        if(isset($_FILES['AdjuntoPD']) && $_FILES['AdjuntoPD']['error'] == 0){
            $dir_subida = 'Archivos/proyectos_dirigidos/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoPD']['name']);
            if (move_uploaded_file($_FILES['AdjuntoPD']['tmp_name'], $fichero_subido))
                $AdjuntoPD = basename($_FILES['AdjuntoPD']['name']);
        }

        //recoge los datos del proyecto dirigido
        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"],$AdjuntoPD);
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
                    // Si no ha habido errores subimos el fichero
                    if($_FILES['AdjuntoPD']['error'] == 0){
                        $dir_subida = 'Archivos/proyectos_dirigidos/';
                        $fichero_subido = $dir_subida . basename($_FILES['AdjuntoPD']['name']);
                        if (move_uploaded_file($_FILES['AdjuntoPD']['tmp_name'], $fichero_subido))
                            $AdjuntoPD = basename($_FILES['AdjuntoPD']['name']);
                    }
                    $proyectoDirigido->setAdjunto($AdjuntoPD);

                    $proyectoDirigido->AltaProyectoDirigido();
                    $proyectoDirigido->Dirige( $CodigoPD, $login);
                    header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=".$login);
                }

        }

        break;


//Alta proyecto dirigido admin
    case 'altaProyectoDirigidoAdmin':

        // Subimos el fichero si viene alguno
        $AdjuntoPD = '';
        if(isset($_FILES['AdjuntoPD']) && $_FILES['AdjuntoPD']['error'] == 0){
            $dir_subida = 'Archivos/proyectos_dirigidos/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoPD']['name']);
            if (move_uploaded_file($_FILES['AdjuntoPD']['tmp_name'], $fichero_subido))
                $AdjuntoPD = basename($_FILES['AdjuntoPD']['name']);
        }
        //recoge los datos del proyecto dirigido
        $proyectoDirigido = new ProyectosDirigidos($_POST["CodigoPD"],$_POST["TituloPD"],$_POST["AlumnoPD"],$_POST["FechaLecturaPD"],$_POST["CalificacionPD"],$_POST["URLPD"],$_POST["CotutorPD"],$_POST["TipoPD"],$AdjuntoPD);
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

                // Si no ha habido errores subimos el fichero
                if($_FILES['AdjuntoPD']['error'] == 0){
                    $dir_subida = 'Archivos/proyectos_dirigidos/';
                    $fichero_subido = $dir_subida . basename($_FILES['AdjuntoPD']['name']);
                    if (move_uploaded_file($_FILES['AdjuntoPD']['tmp_name'], $fichero_subido))
                        $AdjuntoPD = basename($_FILES['AdjuntoPD']['name']);
                }
                $proyectoDirigido->setAdjunto($AdjuntoPD);

                $proyectoDirigido->AltaProyectoDirigido();
                $proyectoDirigido->Dirige($CodigoPD, $login);
                header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
            }

        }

    break;

//Consultar proyectos dirigidos para modificar
    case 'consultarProyectoDirigido':
        $tipou=$_SESSION["TipoUsuario"];
        $proyectoDirigido = new ProyectosDirigidos("","","","","","","","","");
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

        // Subimos el fichero si viene alguno
        $AdjuntoPD = '';
        if(isset($_FILES['AdjuntoPD']) && $_FILES['AdjuntoPD']['error'] == 0){
            $dir_subida = 'Archivos/proyectos_dirigidos/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoPD']['name']);
            if (move_uploaded_file($_FILES['AdjuntoPD']['tmp_name'], $fichero_subido))
                $AdjuntoPD = basename($_FILES['AdjuntoPD']['name']);
        }

        $tipou=$_SESSION["TipoUsuario"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

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

        $proyectoDirigido = new ProyectosDirigidos($CodigoPD, $TituloPD, $AlumnoPD, $FechaLecturaPD, $CalificacionPD, $URLPD, $CotutorPD, $TipoPD, $AdjuntoPD);
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
                require_once "View/ProyectoDirigido/modificarProyectoDirigidoAdmin.php";
            }
        }
        else{

            // Si tiene marcado el check de eliminar lo eliminamos
            if( isset($_POST["AdjuntoPD_delete"]) && $_POST["AdjuntoPD_delete"] == '1' )
                @unlink('Archivos/proyectos_dirigidos/' . $_POST["AdjuntoPD_old"]);

            // Subimos el fichero si viene alguno
            if(isset($_FILES['AdjuntoPD']) && $_FILES['AdjuntoPD']['error'] == 0){
                $dir_subida = 'Archivos/proyectos_dirigidos/';
                $fichero_subido = $dir_subida . basename($_FILES['AdjuntoPD']['name']);
                if (move_uploaded_file($_FILES['AdjuntoPD']['tmp_name'], $fichero_subido)){
                    $AdjuntoPD = basename($_FILES['AdjuntoPD']['name']);

                    // Si teniamos un archivo anterior lo eliminamos
                    if( $_POST["AdjuntoPD_old"] )
                        @unlink('Archivos/proyectos_dirigidos/' . $_POST["AdjuntoPD_old"]);

                }
                $proyectoDirigido->setAdjunto($AdjuntoPD);
            }



            $proyectoDirigido->ModificarProyectoDirigido($CodigoPD);
            $proyectoDirigido->BorrarDirige( $CodigoPD, $LoginAnt);
            $proyectoDirigido->Dirige($CodigoPD, $Login);

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
            $lista = new ProyectosDirigidos("","","","","","","","", "");
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
        $lista = new ProyectosDirigidos("", "", "", "", "", "", "", "", "");
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
        $ProyectoDirigido = new ProyectosDirigidos("","","","","","","","", "");
        $ProyectoDirigido->BorrarDirige($CodigoPD, $LoginU);
        $ProyectoDirigido->BorrarProyectoDirigido($CodigoPD);
        $tipou=$_SESSION["TipoUsuario"];
        if($tipou == 'U'){
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidos&LoginU=$LoginU");
        }else{
            header("Location: index.php?controlador=ProyectosDirigidos&evento=listarProyectosDirigidosAdmin");
        }
        break;

//Buscar proyectos dirigidos
    case 'buscarProyectoDirigido':
        $buscar= $_POST['textoBusqueda'];

        $ProyectoDirigido = new ProyectosDirigidos("","","","","","","","","");
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
