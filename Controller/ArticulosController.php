<?php

// Controlador de Artículos
require_once 'Model/Usuarios.php';
require_once 'Model/Articulo.php';
require_once 'Controller/ControllerController.php';

$evento = $_REQUEST['evento'];

switch ($evento) {

    //lista de artículos para el usuario
    case 'listarArticulos':

        $LoginU = $_SESSION["loginU"];

        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  
        $listaArticulos = $articulo->ListarArticulos($LoginU, '');
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaArticulos)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Articulo/listarArticulos.php";
    break;

    //lista de artículos para el administrador
    case 'listarArticulosAdmin':
        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  
        $listaArticulos = $articulo->ListarArticulos('', '');
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaArticulos)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Articulo/listarArticulosAdmin.php";
    break;

    //busca una lista de artículos para el usuario
    case 'buscarArticulo':

        $LoginU = $_SESSION["loginU"];
        $TituloBusqueda = $_POST["textoBusqueda"];

        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  
        $listaArticulos = $articulo->ListarArticulos($LoginU, $TituloBusqueda);
        $listaResultado = array();
        if(mysqli_num_rows($listaArticulos) > 0){
            while($row = mysqli_fetch_array($listaArticulos)){
                array_push($listaResultado, $row);
            }
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Articulo/listarArticulos.php";

    break;

    //busca una lista de artículos para el administrador
    case 'buscarArticuloAdmin':

        $TituloBusqueda = $_POST["textoBusqueda"];

        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  
        $listaArticulos = $articulo->ListarArticulos('', $TituloBusqueda);
        $listaResultado = array(); 
        if(mysqli_num_rows($listaArticulos) > 0){
            while($row = mysqli_fetch_array($listaArticulos)){
                array_push($listaResultado, $row);
            }
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Articulo/listarArticulosAdmin.php";

    break;

    // Página alta de un artículo
    case "paginaAltaArticulo":
        require_once "View/Articulo/insertarArticulo.php";
    break;

    // Página alta de un artículo para administrador
    case "paginaAltaArticuloAdmin":

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["ConsultarU"] = $consulta;

        require_once "View/Articulo/insertarArticuloAdmin.php";
    break;

    // Crear articulo
    case "altaArticulo":

        $loginU = $_POST["loginU"] ;
        $codigoA = $_POST["CodigoA"];
        $tituloA = $_POST["TituloA"];
        $estadoA = $_POST["EstadoA"];
        $autores = $_POST["autores"];
        $tituloR = $_POST["TituloR"];
        $issn = $_POST["ISSN"];
        $volumenR = $_POST["VolumenR"];
        $pagIniA = $_POST["PagIniA"];
        $pagFinA = $_POST["PagFinA"];
        $fechaPublicacionR = $_POST["FechaPublicacionR"];

        $articulo = new Articulo($codigoA, $tituloA, $tituloR, $issn, $volumenR, $pagIniA, $pagFinA, $fechaPublicacionR, $estadoA);

        // Validamos si es correcto o no el formulario
        $errores    = $articulo->validarArticulo($_POST);

        if(!empty($errores)){

            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Articulo/insertarArticulo.php";

        }
        else{

            // Comprobamos si existe el artículo, en caso de ser así actualizamos
            if( $articulo->existeArticulo($codigoA) ){
                $articulo->ModificarArticulo($codigoA);
            }
            else{
                // Sino existe insertamos
                $articulo->AltaArticulo();
            }

            $articulo->UpdateAutorArticulo($codigoA, $autores);
            $articulo->UpdateUsuarioArticulo($codigoA, $loginU);

            header("location: index.php?controlador=Articulos&evento=listarArticulos");

        }

    break;

    // Crear articulo para administrador
    case "altaArticuloAdmin":

        $loginU = $_POST["loginU"] ;
        $codigoA = $_POST["CodigoA"];
        $tituloA = $_POST["TituloA"];
        $estadoA = $_POST["EstadoA"];
        $autores = $_POST["autores"];
        $tituloR = $_POST["TituloR"];
        $issn = $_POST["ISSN"];
        $volumenR = $_POST["VolumenR"];
        $pagIniA = $_POST["PagIniA"];
        $pagFinA = $_POST["PagFinA"];
        $fechaPublicacionR = $_POST["FechaPublicacionR"];

        $articulo = new Articulo($codigoA, $tituloA, $tituloR, $issn, $volumenR, $pagIniA, $pagFinA, $fechaPublicacionR, $estadoA);

        // Validamos si es correcto o no el formulario
        $errores    = $articulo->validarArticuloAdmin($_POST);

        if(!empty($errores)){

            $Usuario = new Usuarios("","","","","","","","","");
            $consultarUsuarios = $Usuario->ListarUsuarios();

            $consulta = array();
            while($row = mysqli_fetch_array($consultarUsuarios)){
                array_push($consulta, $row);
            }
            $_SESSION["ConsultarU"] = $consulta;
    
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Articulo/insertarArticuloAdmin.php";

        }
        else{

            // Comprobamos si existe el artículo, en caso de ser así actualizamos
            if( $articulo->existeArticulo($codigoA) ){

                $articulo->ModificarArticulo($codigoA);
                $articulo->UpdateAutorArticulo($codigoA, $autores);
                $articulo->UpdateUsuarioArticulo($codigoA, $loginU);

            }
            else{
                // Sino existe insertamos
                $articulo->AltaArticulo();
                $articulo->UpdateAutorArticulo($codigoA, $autores);
                $articulo->UpdateUsuarioArticulo($codigoA, $loginU);
            }

            header("location: index.php?controlador=Articulos&evento=listarArticulosAdmin");

        }

    break;

    // Página modificar un artículo
    case "paginaEditarArticulo":
        $CodigoA = $_REQUEST["CodigoA"];
        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  

        // Consultamos la informacion del articulo
        $consultaA = $articulo->ConsultarArticulo($CodigoA);
        $consultarArticulo = array();
        while($row = mysqli_fetch_array($consultaA)){
            array_push($consultarArticulo, $row);
        }

        // Consultamos los autores del articulo
        $consultaAut = $articulo->ConsultarAutores($CodigoA);
        $consultarArtores= array();
        while($row = mysqli_fetch_array($consultaAut)){
            array_push($consultarArtores, $row);
        }

        $_SESSION["ConsultarA"] = $consultarArticulo;
        $_SESSION["ConsultarAutores"] = $consultarArtores;

        require_once "View/Articulo/modificarArticulo.php";
    break;

    // Página modificar un artículo para administrador
    case "paginaEditarArticuloAdmin":

        $CodigoA = $_REQUEST["CodigoA"];
        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  

        // Consultamos la informacion del articulo
        $consultaA = $articulo->ConsultarArticulo($CodigoA);
        $consultarArticulo = array();
        while($row = mysqli_fetch_array($consultaA)){
            array_push($consultarArticulo, $row);
        }

        // Consultamos los autores del articulo
        $consultaAut = $articulo->ConsultarAutores($CodigoA);
        $consultarArtores= array();
        while($row = mysqli_fetch_array($consultaAut)){
            array_push($consultarArtores, $row);
        }

        // Consultamos los usuarios del artículo
        $consultaUA = $articulo->ConsultarUsuarios($CodigoA);
        $consultarUsuariosArticulo = array();
        while($row = mysqli_fetch_array($consultaUA)){
            array_push($consultarUsuariosArticulo, $row["LoginU"]);
        }

        // Obtenemos el listado general de usuario
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }

        $_SESSION["ConsultarA"] = $consultarArticulo;
        $_SESSION["ConsultarAutores"] = $consultarArtores;
        $_SESSION["ConsultarUsuArt"] = $consultarUsuariosArticulo;
        $_SESSION["ConsultarU"] = $consulta;

        require_once "View/Articulo/modificarArticuloAdmin.php";
    break;

    // Modifica un articulo
    case "editarArticulo":

        $loginU = $_POST["loginU"] ;
        $codigoA = $_POST["CodigoA"];
        $tituloA = $_POST["TituloA"];
        $estadoA = $_POST["EstadoA"];
        $autores = $_POST["autores"];
        $tituloR = $_POST["TituloR"];
        $issn = $_POST["ISSN"];
        $volumenR = $_POST["VolumenR"];
        $pagIniA = $_POST["PagIniA"];
        $pagFinA = $_POST["PagFinA"];
        $fechaPublicacionR = $_POST["FechaPublicacionR"];

        $articulo = new Articulo($codigoA, $tituloA, $tituloR, $issn, $volumenR, $pagIniA, $pagFinA, $fechaPublicacionR, $estadoA);

        // Validamos si es correcto o no el formulario
        $errores    = $articulo->validarArticulo($_POST);

        if(!empty($errores)){

            // Consultamos la informacion del articulo
            $consultaA = $articulo->ConsultarArticulo($codigoA);
            $consultarArticulo = array();
            while($row = mysqli_fetch_array($consultaA)){
                array_push($consultarArticulo, $row);
            }

            // Consultamos los autores del articulo
            $consultaAut = $articulo->ConsultarAutores($codigoA);
            $consultarArtores= array();
            while($row = mysqli_fetch_array($consultaAut)){
                array_push($consultarArtores, $row);
            }

            $_SESSION["ConsultarA"] = $consultarArticulo;
            $_SESSION["ConsultarAutores"] = $consultarArtores;
            
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Articulo/modificarArticulo.php";

        }
        else{

            $articulo->ModificarArticulo($codigoA);
            $articulo->UpdateAutorArticulo($codigoA, $autores);
            $articulo->UpdateUsuarioArticulo($codigoA, $loginU);

            header("location: index.php?controlador=Articulos&evento=listarArticulos");

        }

    break;

    // Modifica un articulo para un administrador
    case "editarArticuloAdmin":

        $loginU = $_POST["loginU"] ;
        $codigoA = $_POST["CodigoA"];
        $tituloA = $_POST["TituloA"];
        $estadoA = $_POST["EstadoA"];
        $autores = $_POST["autores"];
        $tituloR = $_POST["TituloR"];
        $issn = $_POST["ISSN"];
        $volumenR = $_POST["VolumenR"];
        $pagIniA = $_POST["PagIniA"];
        $pagFinA = $_POST["PagFinA"];
        $fechaPublicacionR = $_POST["FechaPublicacionR"];

        $articulo = new Articulo($codigoA, $tituloA, $tituloR, $issn, $volumenR, $pagIniA, $pagFinA, $fechaPublicacionR, $estadoA);

        // Validamos si es correcto o no el formulario
        $errores    = $articulo->validarArticuloAdmin($_POST);

        if(!empty($errores)){

            // Consultamos la informacion del articulo
            $consultaA = $articulo->ConsultarArticulo($codigoA);
            $consultarArticulo = array();
            while($row = mysqli_fetch_array($consultaA)){
                array_push($consultarArticulo, $row);
            }

            // Consultamos los autores del articulo
            $consultaAut = $articulo->ConsultarAutores($codigoA);
            $consultarArtores= array();
            while($row = mysqli_fetch_array($consultaAut)){
                array_push($consultarArtores, $row);
            }

            // Consultamos los usuarios del artículo
            $consultaUA = $articulo->ConsultarUsuarios($codigoA);
            $consultarUsuariosArticulo = array();
            while($row = mysqli_fetch_array($consultaUA)){
                array_push($consultarUsuariosArticulo, $row["LoginU"]);
            }

            // Obtenemos el listado general de usuario
            $Usuario = new Usuarios("","","","","","","","","");
            $consultarUsuarios = $Usuario->ListarUsuarios();

            $consulta = array();
            while($row = mysqli_fetch_array($consultarUsuarios)){
                array_push($consulta, $row);
            }

            $_SESSION["ConsultarA"] = $consultarArticulo;
            $_SESSION["ConsultarAutores"] = $consultarArtores;
            $_SESSION["ConsultarUsuArt"] = $consultarUsuariosArticulo;
            $_SESSION["ConsultarU"] = $consulta;

            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Articulo/modificarArticuloAdmin.php";

        }
        else{

            $articulo->ModificarArticulo($codigoA);
            $articulo->UpdateAutorArticulo($codigoA, $autores);
            $articulo->UpdateUsuarioArticulo($codigoA, $loginU);

            header("location: index.php?controlador=Articulos&evento=listarArticulosAdmin");

        }

    break;

    case "borrarArticulo":

        $LoginU = $_SESSION["loginU"];
        $CodigoA = $_REQUEST["CodigoA"];

        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  
        $articulo->EliminarArticuloUsuario($CodigoA, $LoginU);
        $listaArticulos = $articulo->ListarArticulos($LoginU, '');
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaArticulos)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Articulo/listarArticulos.php";

    break;

    case "borrarArticuloAdmin":

        $CodigoA = $_REQUEST["CodigoA"];

        $articulo = new Articulo('', '', '', '', '', '', '', '', '');  
        $articulo->EliminarArticuloAdministrador($CodigoA);
        $listaArticulos = $articulo->ListarArticulos('', '');
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaArticulos)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Articulo/listarArticulosAdmin.php";

    break;

    default:
        # code...
        echo "ACCION NO REGISTRADA";
    break;

}

?>