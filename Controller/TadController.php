<?php
// Controlador de Tad

require_once 'Model/Tad.php';
require_once 'Model/Usuarios.php';
require_once 'Controller/ControllerController.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

// Página insertar tad
    case "paginaInsertarTad":
        require_once "View/Tad/insertarTad.php";
        break;

// Página insertar tad admin
    case "paginaInsertarTadAdmin":

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;
        require_once "View/Tad/insertarTadAdmin.php";
        break;

//Dar de alta un tad
    case 'altaTad':

        $loginU=$_POST["LoginU"];
        $codigoTad = $_REQUEST["CodigoTAD"];

        // Subimos el fichero si viene alguno
        $AdjuntoTAD = '';
        if(isset($_FILES['AdjuntoTAD']) && $_FILES['AdjuntoTAD']['error'] == 0){
            $dir_subida = 'Archivos/tads/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoTAD']['name']);
            if (move_uploaded_file($_FILES['AdjuntoTAD']['tmp_name'], $fichero_subido))
                $AdjuntoPD = basename($_FILES['AdjuntoTAD']['name']);
        }

        //recoge los datos del TAD
        $tad = new Tad($_POST["CodigoTAD"],$_POST["TituloTAD"],$_POST["AlumnoTAD"],$_POST["FechaLecturaTAD"],$_POST["LoginU"],$AdjuntoTAD);
        $tad->ConsultarTad($codigoTad);
        $errores = $tad->validarTad($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/Tad/insertarTad.php";
        }
        else{

            $consultaT = $tad->ConsultarTad($codigoTad);

            if($consultaT->num_rows > 0){    // Existe Tad
                $errores = array("CodigoTAD", "TituloTAD", "AlumnoTAD", "LoginU");
                $msgError = "El Tad: " . $_POST["CodigoTAD"] . " ya existe, no puede insertar el mismo.";
                require_once "View/Tad/insertarTad.php";
            }else{
                // Si no ha habido errores subimos el fichero
                if($_FILES['AdjuntoTAD']['error'] == 0){
                    $dir_subida = 'Archivos/tads/';
                    $fichero_subido = $dir_subida . basename($_FILES['AdjuntoTAD']['name']);
                    if (move_uploaded_file($_FILES['AdjuntoTAD']['tmp_name'], $fichero_subido))
                        $AdjuntoTAD = basename($_FILES['AdjuntoTAD']['name']);
                    $tad->setAdjunto($AdjuntoTAD);
                }

                $tad->AltaTad();
                header("Location: index.php?controlador=Tad&evento=listarTad&LoginU=".$loginU);
            }

        }

    break;

//Dar de alta un tad como Admin
    case 'altaTadAdmin':
        // Subimos el fichero si viene alguno
        $AdjuntoTAD = '';
        if(isset($_FILES['AdjuntoTAD']) && $_FILES['AdjuntoTAD']['error'] == 0){
            $dir_subida = 'Archivos/tads/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoTAD']['name']);
            if (move_uploaded_file($_FILES['AdjuntoTAD']['tmp_name'], $fichero_subido))
                $AdjuntoPD = basename($_FILES['AdjuntoTAD']['name']);
        }

        //recoge los datos del TAD
		$loginU=$_POST["LoginU"];
        $tad = new Tad($_POST["CodigoTAD"],$_POST["TituloTAD"],$_POST["AlumnoTAD"],$_POST["FechaLecturaTAD"],$_POST["LoginU"],$AdjuntoTAD);
		$codigoTad = $_REQUEST["CodigoTAD"];

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $errores = $tad->validarTad($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/Tad/insertarTadAdmin.php";
        }
        else{

            $consultaT = $tad->ConsultarTad($codigoTad);

            if($consultaT->num_rows > 0){    // Existe Tad
                $errores = array("CodigoTAD", "TituloTAD", "AlumnoTAD", "LoginU");
                $msgError = "El Tad: " . $_POST["CodigoTAD"] . " ya existe, no puede insertar el mismo.";
                require_once "View/Tad/insertarTadAdmin.php";
            }else{
                // Si no ha habido errores subimos el fichero
                if($_FILES['AdjuntoTAD']['error'] == 0){
                    $dir_subida = 'Archivos/tads/';
                    $fichero_subido = $dir_subida . basename($_FILES['AdjuntoTAD']['name']);
                    if (move_uploaded_file($_FILES['AdjuntoTAD']['tmp_name'], $fichero_subido))
                        $AdjuntoTAD = basename($_FILES['AdjuntoTAD']['name']);
                }
                $tad->setAdjunto($AdjuntoTAD);
                $tad->AltaTad();
                header("Location: index.php?controlador=Tad&evento=listarTadAdmin");
            }

        }


        break;

//Consultar un tad para modificar
    case 'consultarTad':

        $Tad = new Tad("","","","","","");
        $CodigoTAD = $_REQUEST['CodigoTAD'];
        $consultaT = $Tad->ConsultarTad($CodigoTAD);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaT)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarTad"] = $consulta;

        require_once "View/Tad/modificarTad.php";

        break;

    //Consultar un tad para modificar
    case 'consultarTadAdmin':

     $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $Tad = new Tad("","","","","","");
        $CodigoTAD = $_REQUEST['CodigoTAD'];
        $consultaT = $Tad->ConsultarTad($CodigoTAD);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaT)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarTad"] = $consulta;

        require_once "View/Tad/modificarTadAdmin.php";

        break;

//Modificar un Tad
    case 'modificarTad':

        // Subimos el fichero si viene alguno
        $AdjuntoTAD = '';
        if(isset($_FILES['AdjuntoTAD']) && $_FILES['AdjuntoTAD']['error'] == 0){
            $dir_subida = 'Archivos/tads/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoTAD']['name']);
            if (move_uploaded_file($_FILES['AdjuntoTAD']['tmp_name'], $fichero_subido))
                $AdjuntoTAD = basename($_FILES['AdjuntoTAD']['name']);
        }

        $CodigoTAD = $_POST['CodigoTAD'];
        $TituloTAD = $_POST['TituloTAD'];
        $AlumnoTAD = $_POST['AlumnoTAD'];
        $FechaLecturaTAD = $_POST['FechaLecturaTAD'];
        $LoginU = $_POST['LoginU'];


        $tad = new Tad( $CodigoTAD,$TituloTAD, $AlumnoTAD ,$FechaLecturaTAD, $LoginU, $AdjuntoTAD );
        $errores    = $tad->validarTad($_POST);
        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            $consultaTad = $tad->ConsultarTad($CodigoTAD);
            $consulta = array();
            while($row1 = mysqli_fetch_array($consultaTad)){
                array_push($consulta, $row1);
            }
            $_SESSION["consultarTad"] = $consulta;

            if($tipou == 'U') {
                require_once "View/Tad/modificarTad.php";
            }else{
                require_once "View/Tad/modificarTadAdmin.php";
            }
        }
        else{
            // Si tiene marcado el check de eliminar lo eliminamos
            if( isset($_POST["AdjuntoTAD_delete"]) && $_POST["AdjuntoTAD_delete"] == '1' )
                @unlink('Archivos/tads/' . $_POST["AdjuntoTAD_old"]);

            // Subimos el fichero si viene alguno
            if(isset($_FILES['AdjuntoTAD']) && $_FILES['AdjuntoTAD']['error'] == 0){
                $dir_subida = 'Archivos/tads/';
                $fichero_subido = $dir_subida . basename($_FILES['AdjuntoTAD']['name']);
                if (move_uploaded_file($_FILES['AdjuntoTAD']['tmp_name'], $fichero_subido)){
                    $AdjuntoPD = basename($_FILES['AdjuntoTAD']['name']);

                    // Si teniamos un archivo anterior lo eliminamos
                    if( $_POST["AdjuntoTAD_old"] )
                        @unlink('Archivos/tads/' . $_POST["AdjuntoTAD_old"]);

                }

            }

            $tad->setAdjunto($AdjuntoTAD);

            $tad->ModificarTad($CodigoTAD);
            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Tad&evento=listarTad&LoginU=$LoginU");
            }else{
                header("Location: index.php?controlador=Tad&evento=listarTadAdmin");
            }
        }


        break;

//Listar tad por usuario
    case 'listarTad':

        $LoginU = $_REQUEST['LoginU'];
        $lista = new Tad("","","","","");

        $listaTad= $lista->ListarTad($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTad)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarTad"] = $listaResultado;


        require_once("View/Tad/listarTad.php");

        break;

//Listar todos los tad como admin
    case 'listarTadAdmin':

        $lista = new Tad("","","","","");

        $listaTad= $lista->ListarTadAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTad)){
            array_push($listaResultado, $row);
        }

        $_SESSION["listarTadAdmin"] = $listaResultado;

        require_once("View/Tad/listarTadAdmin.php");

        break;

//Buscar tad
    case 'buscarTad':
        $buscar= $_POST['textoBusqueda'];

        $Tad = new Tad("","","","","");
        $consultarTad = $Tad->BuscarTad($buscar);

        if(!empty($consultarTad)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarTad)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Tad/buscarTad.php";
            }else{
                require_once "View/Tad/BuscarTadAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

//Borrar tad
    case 'borrarTad':
        $CodigoTAD=$_REQUEST["CodigoTAD"];
        $loginU=$_REQUEST["LoginU"];
        $Tad = new Tad("","","","","");


        $Tad->BorrarTad($CodigoTAD);


        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Tad&evento=listarTad&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Tad&evento=listarTadAdmin");
        }
        break;


    default:

        echo "ACCION NO REGISTRADA";
        break;
}

?>

