<?php
// Controlador de Usuarios
require_once 'Model/Usuarios.php';
require_once 'Model/Universidad.php';
require_once 'Model/TituloAcademico.php';
require_once 'Controller/ControllerController.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    // Registrarse
    case "registrarse":
        require_once "View/Usuario/registrarse.php";
    break;

    // Consulta del usuario cuando se pincha el logotipo una vez logueado
    case "consultarUsuarioActual":
        require_once "View/Usuario/consultarUsuario.php";
    break;

    // Insertar universidad
    case "insertarUniversidad":
        require_once "View/Universidad/insertarUniversidad.php";
    break;

    // Insertar titulo académico
    case "insertarTituloAcademico":
        require_once "View/TituloAcademico/insertarTituloAcademico.php";
    break;

    // Página modificar usuario
    case "paginaModificarUsuario":
        require_once "View/Usuario/modificarUsuario.php";
    break;

    // Página alta usuario admin
    case "paginaAltaUsuarioAdmin":
        require_once "View/Usuario/altaUsuarioAdmin.php";
    break;

    // dar de alta un usuario
    case 'altaUsuario':

        if ($_POST["PasswordU"]!= $_POST["PasswordU2"]) {
            anadirMensaje("| SUCCESS | las contraseñas no coninciden","success");
        }else{
        //recoge los datos del usuario
        $usuario = new Usuarios ($_POST["Login"], $_POST["PasswordU"], $_POST["NombreU"],$_POST["ApellidosU"],$_POST["Telefono"], $_POST["Mail"], $_POST["DNI"],$_POST["FechaNacimiento"], $_POST["TipoContrato"],$_POST["Centro"],$_POST["Departamento"],"U");

       $login=$_REQUEST["Login"];
        $usuario -> consultarUsuario($login);
        //comprobamos si existe el usuario
    if(!isset($usuario)){
        anadirMensaje("| SUCCESS | El usuario: ".$_POST["Login"]." ya existe","success");
        header('location: index.php');

    }else{
        //recoge los datos universitarios  y de titulodel formulario
        $universidad= new Universidad($_POST["Login"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
        $tituloAcademico= new TituloAcademico($_POST["Login"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);

        //añade datos universitarios y titulo al usuario
        $usuario->altaUsuario();
        $universidad->AltaUniversidad();
        $tituloAcademico->AltaTituloAcademico();
        header("location: index.php?controlador=Usuarios&evento=listarUsuariosAdmin");

    }}
        break;

// registrar un usuario
    case 'registrarUsuario':

        $usuario = new Usuarios ($_POST["Login"], $_POST["PasswordU"], $_POST["NombreU"],$_POST["ApellidosU"],$_POST["Telefono"], $_POST["Mail"], $_POST["DNI"],$_POST["FechaNacimiento"], $_POST["TipoContrato"],$_POST["Centro"],$_POST["Departamento"],"U");

        // Validamos si es correcto o no el formulario
        $errores    = $usuario->validarRegistrarUsuario($_POST);

        if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Usuario/registrarse.php";
        }
        else{

            // Es correcto continuamos con el registro

            //recoge los datos universitarios  y de titulodel formulario
            $universidad= new Universidad($_POST["Login"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
            $tituloAcademico= new TituloAcademico($_POST["Login"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);

            //añade datos universitarios y titulo al usuario
            $usuario->altaUsuario();
            $universidad->AltaUniversidad();
            $tituloAcademico->AltaTituloAcademico();
            require_once "View/login.php";

        }

    break;

// dar de alta un nuevo titulo academico
    case 'altaTituloAcademico':
        $LoginU= $_POST["LoginU"];
        $tituloAcademico= new TituloAcademico($_POST["LoginU"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);
        
        // Validamos si es correcto o no el formulario
        $errores    = $tituloAcademico->validarTituloAcademico($_POST);

        if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/TituloAcademico/insertarTituloAcademico.php";
        }
        else{
            $tituloAcademico->AltaTituloAcademico();
            header("location: index.php?controlador=Usuarios&evento=consultarUsuario&LoginU=$LoginU");
        }

        break;

// dar de alta una nueva universidad
    case 'altaUniversidad':
        $LoginU= $_POST["LoginU"];
        $universidad= new Universidad($_POST["LoginU"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);

        // Validamos si es correcto o no el formulario
        $errores    = $universidad->validarUniversidad($_POST);

        if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Universidad/insertarUniversidad.php";
        }
        else{
                $universidad->AltaUniversidad();
                header("location: index.php?controlador=Usuarios&evento=consultarUsuario&LoginU=$LoginU");
        }

        break;

//cerrar session
    case 'logOut':

          session_unset();
          session_destroy();

          header("location: index.php");
      break;

//loguear usuario
  case 'Login':
     $LoginU= $_POST["LoginU"];
     $PasswordU= $_POST["PasswordU"];
    $usuario = new Usuarios( $LoginU,$PasswordU,"","","","","","","","","","");
     $usuario->login();

    if (isset( $_SESSION["Usuario"])) {


        header("location: index.php?controlador=Usuarios&evento=consultarUsuario&LoginU=$LoginU");
    } else {

        header("location: index.php");
    }

      break;

//consultar perfil
    case 'consultarUsuario':

        //conuslta datos del usuario
        $Login=$_REQUEST["LoginU"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuario = $Usuario->consultarUsuario($Login);

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuario)){
            array_push($consulta, $row);
        }

		//lista datos de titulos del usuario
        $consultarTitulo = $Usuario->ConsultarTitulos($Login);

        $consultaUT = array();
        while($row3 = mysqli_fetch_array($consultarTitulo)){
            array_push($consultaUT, $row3);
        }
        //lista datos universidades del usuario

        $consultarUniversidad = $Usuario->ConsultarUniversidades($Login);

        $consultaUA = array();
        while($row2 = mysqli_fetch_array($consultarUniversidad)){
            array_push($consultaUA, $row2);
        }

        $_SESSION["ConsultarU"] = $consulta;
        $_SESSION["ConsultaUT"] = $consultaUT;
        $_SESSION["ConsultaUA"] = $consultaUA;



		require_once "View/Usuario/consultarUsuario.php";
    break;
    //consultar detalle del usuario
    case 'consultarDetalleUsuario':

        //conuslta datos del usuario
        $Login=$_REQUEST["LoginU"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuario = $Usuario->consultarUsuario($Login);

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuario)){
            array_push($consulta, $row);
        }

        //lista datos de titulos del usuario
        $consultarTitulo = $Usuario->ConsultarTitulos($Login);

        $consultaUT = array();
        while($row3 = mysqli_fetch_array($consultarTitulo)){
            array_push($consultaUT, $row3);
        }
        //lista datos universidades del usuario

        $consultarUniversidad = $Usuario->ConsultarUniversidades($Login);

        $consultaUA = array();
        while($row2 = mysqli_fetch_array($consultarUniversidad)){
            array_push($consultaUA, $row2);
        }

        $_SESSION["ConsultarU"] = $consulta;
        $_SESSION["ConsultaUT"] = $consultaUT;
        $_SESSION["ConsultaUA"] = $consultaUA;

        $tipou=$_SESSION["TipoUsuario"];
        if($tipou == 'U') {
            require_once "View/Usuario/consultarDetalleUsuario.php";
        }else{
            require_once "View/Usuario/consultarDetalleUsuarioAdmin.php";
        }
        break;

//consultar titulo academico
    case 'consultarTituloAcademico':
        $LoginU=$_REQUEST["LoginU"];
        $NombreTitulo=$_REQUEST["NombreTitulo"];
        $titulo = new TituloAcademico("","","","");
        $consulta= $titulo->ConsultaTituloAcademico($LoginU,$NombreTitulo);


        $consultaTitulo = array();
        while($row2 = mysqli_fetch_array($consulta)){
            array_push($consultaTitulo, $row2);
        }

        $_SESSION["ConsultarTitulo"] = $consultaTitulo;

        require_once "View/TituloAcademico/modificarTituloAcademico.php";
        break;

//modificar usuario
    case 'modificarUsuario':

        $LoginU = $_POST['LoginU'];
        $NombreU = $_POST['NombreU'];
        $ApellidosU = $_POST['ApellidosU'];
        $Telefono = $_POST['Telefono'];
        $Mail = $_POST['Mail'];
        $DNI = $_POST['DNI'];
        $FechaNacimiento = $_POST['FechaNacimiento'];
        $TipoContrato = $_POST['TipoContrato'];
        $Centro = $_POST['Centro'];
        $Departamento = $_POST['Departamento'];

        $usuario = new Usuarios($LoginU,"", $NombreU, $ApellidosU, $Telefono, $Mail, $DNI,$FechaNacimiento, $TipoContrato,$Centro,$Departamento);

        // Validamos si es correcto o no el formulario
        $errores    = $usuario->validarPerfil($_POST);

        if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Usuario/modificarUsuario.php";
        }
        else{

            $usuario->ModificarUsuario($LoginU);
            $tipou=$_SESSION["TipoUsuario"]; 
            if($tipou == 'U'){
                header("Location: index.php?controlador=Usuarios&evento=consultarUsuario&LoginU=$LoginU");
            }else{
                header("Location: index.php?controlador=Usuarios&evento=consultarDetalleUsuario&LoginU=$LoginU");
            }

        }

        break;

//modificar titulo academico
    case 'modificarTituloAcademico':

        $LoginU = $_POST['LoginU'];
        $NombreTitulo = $_POST['NombreTitulo'];
        $FechaTitulo = $_POST['FechaTitulo'];
        $CentroTitulo = $_POST['CentroTitulo'];

        $titulo = new TituloAcademico($LoginU, $NombreTitulo, $FechaTitulo, $CentroTitulo);
        $titulo->ModificarTituloAcademico($LoginU,$NombreTitulo);


        header("Location: index.php?controlador=Usuarios&evento=consultarUsuario&LoginU=$LoginU");

        break;
//lista de usuarios para el administrador
    case 'listarUsuariosAdmin':
        $lista = new Usuarios("","","","","","","","","","","","");
        //todos los usuarios
        $listaUsuarios = $lista->ListarUsuarios();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaUsuarios)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Usuario/listarUsuariosAdmin.php";
        break;
//lista de usuarios para el usuario
    case 'listarUsuarios':
        $lista = new Usuarios("","","","","","","","","","","","");
        //todos los usuarios
        $listaUsuarios = $lista->ListarUsuarios();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaUsuarios)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        require_once "View/Usuario/listarUsuarios.php";
        break;

 //borrar un usuario
    case'borrarUsuario':
        $Login=$_REQUEST["LoginU"];
        $Usuario = new Usuarios("","","","","","","","","");
        $universidad= new Universidad("","","","");
        $tituloAcademico= new TituloAcademico("","","","");

        $tituloAcademico->BorrarTitulosUsuario($Login);
        $universidad-> BorrarUniversidadesUsuario($Login);
        $Usuario->BorrarUsuario($Login);
        header("Location: index.php?controlador=Usuarios&evento=listarUsuariosAdmin");

        break;

//borrar perfil
    case'borrarPerfil':
        $Login=$_REQUEST["LoginU"];
        $Usuario = new Usuarios("","","","","","","","","");
        $universidad= new Universidad("","","","");
        $tituloAcademico= new TituloAcademico("","","","");

        $tituloAcademico->BorrarTitulosUsuario($Login);
        $universidad-> BorrarUniversidadesUsuario($Login);
        $Usuario->BorrarUsuario($Login);
        header("Location: index.php?controlador=Usuarios&evento=logOut");

        break;

  //buscar usuarios
    case 'buscarUsuario':
         $buscar= $_POST['textoBusqueda'];

         $Usuario = new Usuarios("","","","","","","","","");
         $consultarUsuario = $Usuario->BuscarUsuario($buscar);

        if(!empty($consultarUsuario)){
                 $listaResultado = array();
                 while($row = mysqli_fetch_array($consultarUsuario)){
                     array_push($listaResultado, $row);
                 }
                 $_SESSION["listarBusqueda"] = $listaResultado;
            $tipou=$_SESSION["TipoUsuario"]; 
            if($tipou == 'U'){
                require_once "View/Usuario/BuscarUsuario.php";
            }else{
                require_once "View/Usuario/BuscarUsuarioAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
         break;
  default:
    # code...
    echo "ACCION NO REGISTRADA";
    break;
}

?>
