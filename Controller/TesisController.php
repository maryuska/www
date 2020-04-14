<?php
// Controlador de Tad

require_once 'Model/Tesis.php';

require_once 'Model/Usuarios.php';

require_once 'Controller/ControllerController.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

// Página insertar tesis
    case "paginaInsertarTesis":
        require_once "View/Tesis/insertarTesis.php";
        break;

// Página insertar tesis admin
    case "paginaInsertarTesisAdmin":

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        require_once "View/Tesis/insertarTesisAdmin.php";
        break;

//dar de alta una tesis
    case 'altaTesis':
        // Subimos el fichero si viene alguno
        $AdjuntoT = '';
        if(isset($_FILES['AdjuntoT']) && $_FILES['AdjuntoT']['error'] == 0){
            $dir_subida = 'Archivos/tesis/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoT']['name']);
            if (move_uploaded_file($_FILES['AdjuntoT']['tmp_name'], $fichero_subido))
                $AdjuntoT = basename($_FILES['AdjuntoT']['name']);
        }

        //recoge los datos de la tesis
        $login=$_POST["LoginU"];
        $tesis = new Tesis($_POST["CodigoTesis"],$_POST["AutorTesis"],$_POST["FechaInscripcion"],$_POST["FechaLectura"],$_POST["CalificacionTesis"],$_POST["URLTesis"],$_POST["LoginU"],$AdjuntoT);
        $codigoTesis = $_REQUEST["CodigoTesis"];

        $errores = $tesis->validarTesis($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/Tesis/insertarTesis.php";
        }
        else{

            $consultaT = $tesis->ConsultarTesis($codigoTesis);

            if($consultaT->num_rows > 0){    // Existe la tesis
                $errores = array("CodigoTesis", "AutorTesis", "FechaInscripcion", "FechaLectura", "CalificacionTesis", "URLTesis", "LoginU");
                $msgError = "La Tesis: " . $_POST["CodigoTesis"] . " ya existe, no puede insertar la misma.";
                require_once "View/Tesis/insertarTesis.php";
            }else{
                // Si no ha habido errores subimos el fichero
                if($_FILES['AdjuntoT']['error'] == 0){
                    $dir_subida = 'Archivos/tesis/';
                    $fichero_subido = $dir_subida . basename($_FILES['AdjuntoT']['name']);
                    if (move_uploaded_file($_FILES['AdjuntoT']['tmp_name'], $fichero_subido))
                        $AdjuntoT = basename($_FILES['AdjuntoT']['name']);
                }
                $tesis->setAdjunto($AdjuntoT);
                $tesis->AltaTesis();
                header("Location: index.php?controlador=Tesis&evento=listarTesis&LoginU=".$login);
            }

        }

		
        break;

//dar de alta una tesis como admin
    case 'altaTesisAdmin':
        // Subimos el fichero si viene alguno
        $AdjuntoT = '';
        if(isset($_FILES['AdjuntoT']) && $_FILES['AdjuntoT']['error'] == 0){
            $dir_subida = 'Archivos/tesis/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoT']['name']);
            if (move_uploaded_file($_FILES['AdjuntoT']['tmp_name'], $fichero_subido))
                $AdjuntoT = basename($_FILES['AdjuntoT']['name']);
        }

        //recoge los datos de la tesis
        $tesis = new Tesis($_POST["CodigoTesis"],$_POST["AutorTesis"],$_POST["FechaInscripcion"],$_POST["FechaLectura"],$_POST["CalificacionTesis"],$_POST["URLTesis"],$_POST["Login"],$AdjuntoT);
        $codigoTesis = $_REQUEST["CodigoTesis"];

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $errores = $tesis->validarTesis($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/Tesis/insertarTesisAdmin.php";
        }
        else{

            $consultaT = $tesis->ConsultarTesis($codigoTesis);

            if($consultaT->num_rows > 0){    // Existe la tesis

                $errores = array("CodigoTesis", "AutorTesis", "FechaInscripcion", "FechaLectura", "CalificacionTesis", "URLTesis", "LoginU");
                $msgError = "La Tesis: " . $_POST["CodigoTesis"] . " ya existe, no puede insertar la misma.";
                require_once "View/Tesis/insertarTesisAdmin.php";
            }else{
                // Si no ha habido errores subimos el fichero
                if($_FILES['AdjuntoT']['error'] == 0){
                    $dir_subida = 'Archivos/tesis/';
                    $fichero_subido = $dir_subida . basename($_FILES['AdjuntoT']['name']);
                    if (move_uploaded_file($_FILES['AdjuntoT']['tmp_name'], $fichero_subido))
                        $AdjuntoT = basename($_FILES['AdjuntoT']['name']);
                }
                $tesis->setAdjunto($AdjuntoT);
                $tesis->AltaTesis();
                header("Location: index.php?controlador=Tesis&evento=listarTesisAdmin");
            }

        }

        break;

//Consulta de una tesis para modificar
   case 'consultarTesis':

        $Tesis = new Tesis("","","","","","","","");
        $CodigoTesis = $_REQUEST['CodigoTesis'];
        $consultaT = $Tesis->ConsultarTesis($CodigoTesis);
        $consulta = array();
        while($row = mysqli_fetch_array($consultaT)){
            array_push($consulta, $row);
        }
        $_SESSION["consultarTesis"] = $consulta;

        require_once "View/Tesis/modificarTesis.php";

        break;

//Consulta de una tesis para modificar como admin
    case 'consultarTesisAdmin':

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $Tesis = new Tesis("","","","","","","","");
        $CodigoTesis = $_REQUEST['CodigoTesis'];
        $consultaT = $Tesis->ConsultarTesis($CodigoTesis);
        $consulta = array();
        while($row = mysqli_fetch_array($consultaT)){
            array_push($consulta, $row);
        }
        $_SESSION["consultarTesis"] = $consulta;

        require_once "View/Tesis/modificarTesisAdmin.php";

        break;

//Modificar una tesis
    case 'modificarTesis':
       // Subimos el fichero si viene alguno
        $AdjuntoT = '';
        if(isset($_FILES['AdjuntoT']) && $_FILES['AdjuntoT']['error'] == 0){
            $dir_subida = 'Archivos/tesis/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoT']['name']);
            if (move_uploaded_file($_FILES['AdjuntoT']['tmp_name'], $fichero_subido))
                $AdjuntoT = basename($_FILES['AdjuntoT']['name']);
        }

        $tipou=$_SESSION["TipoUsuario"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;


        $CodigoTesis = $_POST['CodigoTesis'];
        $AutorTesis = $_POST['AutorTesis'];
        $FechaInscripcion = $_POST['FechaInscripcion'];
        $FechaLectura = $_POST['FechaLectura'];
        $CalificacionTesis = $_POST['CalificacionTesis'];
        $URLTesis = $_POST['URLTesis'];
        $LoginU = $_POST['LoginU'];
       // $AdjuntoT=$_POST['AdjuntoT'];

        $tesis = new Tesis( $CodigoTesis,$AutorTesis, $FechaInscripcion ,$FechaLectura,$CalificacionTesis,$URLTesis, $LoginU, $AdjuntoT );
        $errores    = $tesis->validarTesis($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            $consultaT = $tesis->ConsultarTesis($CodigoTesis);
            $consulta = array();
            while($row1 = mysqli_fetch_array($consultaT)){
                array_push($consulta, $row1);
            }
            $_SESSION["consultarTesis"] = $consulta;

            if($tipou == 'U') {
                require_once "View/Tesis/modificarTesis.php";
            }else{
                require_once "View/Tesis/modificarTesisAdmin.php";
            }
        }
        else{
            // Si tiene marcado el check de eliminar lo eliminamos
            if( isset($_POST["AdjuntoT_delete"]) && $_POST["AdjuntoT_delete"] == '1' )
                @unlink('Archivos/tesis/' . $_POST["AdjuntoT_old"]);

            // Subimos el fichero si viene alguno
            if(isset($_FILES['AdjuntoT']) && $_FILES['AdjuntoT']['error'] == 0) {
                $dir_subida = 'Archivos/tesis/';
                $fichero_subido = $dir_subida . basename($_FILES['AdjuntoT']['name']);

                if (move_uploaded_file($_FILES['AdjuntoT']['tmp_name'], $fichero_subido)) {
                $AdjuntoT = basename($_FILES['AdjuntoT']['name']);
                    // Si teniamos un archivo anterior lo eliminamos
                    if ($_POST["AdjuntoT_old"]) {
                        @unlink('Archivos/tesis/' . $_POST["AdjuntoT_old"]);
                    }
                }
            }



            $tesis->setAdjunto($AdjuntoT);

            $tesis->ModificarTesis($CodigoTesis);
            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Tesis&evento=listarTesis&LoginU=$LoginU");
            }else{
                header("Location: index.php?controlador=Tesis&evento=listarTesisAdmin");
            }
        }


        break;

//listar tesis por usuario
    case 'listarTesis':

        $LoginU = $_REQUEST['LoginU'];
        $lista = new Tesis("","","","","","","","");

        $listaTesis= $lista->ListarTesis($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTesis)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarTesis"] = $listaResultado;


        require_once("View/Tesis/listarTesis.php");

        break;

//listar todas las tesis como admin
    case 'listarTesisAdmin':

        $lista = new Tesis("","","","","","","","");

        $listaTesis= $lista->ListarTesisAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaTesis)){
            array_push($listaResultado, $row);
        }

        $_SESSION["listarTesisAdmin"] = $listaResultado;

        require_once("View/Tesis/listarTesisAdmin.php");

        break;

//buscar tesis
    case 'buscarTesis':
        $buscar= $_POST['textoBusqueda'];

        $Tesis = new Tesis("","","","","","","","");
        $consultarTesis = $Tesis->BuscarTesis($buscar);

        if(!empty($consultarTesis)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarTesis)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Tesis/buscarTesis.php";
            }else{
                require_once "View/Tesis/BuscarTesisAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

//borrar tesis
    case 'borrarTesis':
        $loginU=$_REQUEST["LoginU"];
        $CodigoTesis=$_REQUEST["CodigoTesis"];
        $Tesis = new Tesis("","","","","","","","");

        $Tesis->BorrarTesis($CodigoTesis);

        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Tesis&evento=listarTesis&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Tesis&evento=listarTesisAdmin");
        }
        break;


    default:

        echo "ACCION NO REGISTRADA";
        break;
}

?>

