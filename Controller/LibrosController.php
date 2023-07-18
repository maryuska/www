<?php
// Controlador de Libros
require_once 'Controller/ControllerController.php';
require_once 'Model/Usuarios.php';
require_once 'Model/Libro.php';
$evento = $_REQUEST['evento'];

switch ($evento) {


// Página insertar libro
    case "paginaInsertarLibro":
        require_once "View/Libro/insertarLibro.php";
        break;

// Página insertar libro admin
    case "paginaInsertarLibroAdmin":

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;
        require_once "View/Estancia/insertarLibroAdmin.php";
        break;


//Dar alta un libro
    case 'altaLibro':

        //recoge los datos del libro
        $loginU=$_POST["LoginU"];
        $libro = new Libro($_POST["CodigoL"],$_POST["AutoresL"],$_POST["TituloL"],$_POST["ISBN"],$_POST["PagIniL"],$_POST["PagFinL"],$_POST["VolumenL"],$_POST["EditorialL"],$_POST["FechaPublicacionL"],$_POST["EditorL"],$_POST["PaisEdicionL"]);
        $CodigoL = $_REQUEST['CodigoL'];

        $errores = $libro->validarLibro($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/Libro/insertarLibro.php";
        }
        else {

            $consultaL = $libro->ConsultarLibro($CodigoL);

            if ($consultaL->num_rows > 0) {    // Existe libro
                $errores = array("CodigoL", "AutoresL", "TituloL", "ISBN", "PagIniL", "PagFinL", "VolumenL", "EditorialL", "FechaPublicaionL", "EditorL", "PaisEdicionL");
                $msgError = "El libro: " . $_POST["CodigoL"] . " ya existe, no puede insertar el mismo.";
                require_once "View/Libro/insertarLibro.php";
            } else {

                $libro->AltaLibro();
                $login = $_REQUEST["LoginU"];
                header("Location: index.php?controlador=Libro&evento=listarLibros&LoginU=" . $login);
            }
        }

        break;

//Dar alta un libro como Admin
    case 'altaLibroAdmin':

        //recoge los datos del libro
        $libro = new Libro($_POST["CodigoL"],$_POST["AutoresL"],$_POST["TituloL"],$_POST["ISBN"],$_POST["PagIniL"],$_POST["PagFinL"],$_POST["VolumenL"],$_POST["EditorialL"],$_POST["FechaPublicacionL"],$_POST["EditorL"],$_POST["PaisEdicionL"]);
        $CodigoL = $_REQUEST['CodigoL'];

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $errores = $libro->validarLibro($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/Libro/insertarLibroAdmin.php";
        }
        else {

            $consultaE = $libro->ConsultarLibro($CodigoL);

            if ($consultaE->num_rows > 0) {    // Existe libro
                $errores = array("CodigoL", "AutoresL", "TituloL", "ISBN", "PagIniL", "PagFinL", "VolumenL", "EditorialL", "FechaPublicaionL", "EditorL", "PaisEdicionL");
                $msgError = "El libro: " . $_POST["CodigoL"] . " ya existe, no puede insertar el mismo.";
                require_once "View/Libro/insertarLibroAdmin.php";
            } else {

                $libro->AltaLibro();
                header("Location: index.php?controlador=Libros&evento=listarLibrosAdmin");
            }
        }
        break;

//Consultar un libro para modificar
    case 'consultarLibro':

        $libro = new Libro("","","","","","","","","","","");
        $CodigoL = $_REQUEST['CodigoL'];
        $consultaL = $libro->ConsultarLibro($CodigoL);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaL)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarLibro"] = $consulta;

        require_once "View/Libro/modificarLibro.php";

        break;

//Consultar un libro para modificar como admin
    case 'consultarLibroAdmin':

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $libro = new Libro("","","","","","","","","","","");
        $CodigoL = $_REQUEST['CodigoL'];
        $consultaL = $libro->ConsultarLibro($CodigoL);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaL)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarLibro"] = $consulta;

        require_once "View/Libro/modificarLibroAdmin.php";

        break;

//Modificar un libro
    case 'modificarLibro':

        $tipou=$_SESSION["TipoUsuario"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $CodigoL = $_POST['CodigoL'];
        $AutoresL = $_POST['AutoresL'];
        $TituloL = $_POST['TituloL'];
        $ISBN = $_POST['ISBN'];
        $PagIniL= $_POST['PagIniL'];
        $PagFinL = $_POST['PagFinL'];
        $VolumenL = $_POST['VolumenL'];
        $EditorialL = $_POST['EditorialL'];
        $FechaPublicaionL= $_POST['FechaPublicacionL'];
        $EditorL = $_POST['EditorL'];
        $PaisEdicionL = $_POST['PaisEdicionL'];

        $libro = new Libro($CodigoL, $AutoresL, $TituloL, $ISBN , $PagIniL, $PagFinL, $VolumenL, $EditorialL, $FechaPublicaionL, $EditorL, $PaisEdicionL);
        $errores    = $libro->validarLibro($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            $consultaL = $libro->ConsultarLibro($CodigoL);
            $consulta = array();
            while($row1 = mysqli_fetch_array($consultaL)){
                array_push($consulta, $row1);
            }
            $_SESSION["consultarLibro"] = $consulta;

            if($tipou == 'U') {
                require_once "View/Estancia/modificarLibro.php";
            }else{
                require_once "View/Estancia/modificarLibroAdmin.php";
            }

            $libro->ModificarEstancia($CodigoL);
            $loginU = $_POST['LoginU'];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Libros&evento=listarLibros&LoginU=$loginU");
            }else{
                header("Location: index.php?controlador=Libros&evento=listarLibrosAdmin");
            }
        }

        break;

//Listar libros de usuario
    case 'listarLibros':
        $LoginU = $_REQUEST['LoginU'];
        $lista = new Libro("","","","","","","","","","","");
        //todos los libros
        $listaLibros = $lista->ListarLibros($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaLibros)){
            array_push($listaResultado, $row);
        }

        $_SESSION["listarLibros"] = $listaResultado;
        require_once("View/Libro/listarLibros.php");

        break;

//Listar todos los libros como admin
    case 'listarLibrosAdmin':

        $lista = new Libro("","","","","","","","","","","");

        //todas los libros
        $listaLibros = $lista->ListarLibrosAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaLibros)){
            array_push($listaResultado, $row);
        }

        $_SESSION["listarLibrosAdmin"] = $listaResultado;

        require_once("View/Libro/listarLibrosAdmin.php");

        break;

//Borrar libro
    case 'borrarLibro':
        $CodigoL=$_REQUEST["CodigoL"];
        $Libro = new Libro("","","","","","","","","","","");

        $Libro->BorrarLibro($CodigoL);

        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Libro&evento=listarLibros&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Libro&evento=listarLibrosAdmin");
        }
        break;

//Buscar libro
    case 'buscarlibro':
        $buscar= $_POST['textoBusqueda'];

        $Libro = new Libro("","","","","","","","","","","");
        $consultarLibro = $Libro->BuscarLibro($buscar);

        if(!empty($consultarLibro)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarLibro)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Libro/buscarLibros.php";
            }else{
                require_once "View/Libro/buscarLibrosAdmin.php";
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
