<?php
// Controlador de Usuarios

require_once '../Model/Usuarios.php';
require_once '../Model/Universidad.php';
require_once '../Model/TituloAcademico.php';
$evento = $_REQUEST['evento'];

switch ($evento) {
    // dar de alta un usuario
    case 'altaUsuario':
        if ($_POST["PasswordU"]!==$_POST["PasswordU2"]) {
            header("location: ../../View/errores.php?PassErr");
        }
        //recoge los datos del usuario
        $usuario = new Usuarios ($_POST["Login"], $_POST["PasswordU"], $_POST["NombreU"],$_POST["ApellidosU"],$_POST["Telefono"], $_POST["Mail"], $_POST["DNI"],$_POST["FechaNacimiento"], $_POST["TipoContrato"],$_POST["Centro"],$_POST["Departamento"],"U");

       $login=$_REQUEST["Login"];
        $usuario -> consultarUsuario($login);
        //comprobamos si existe el usuario
    if($usuario!=null){

        //recoge los datos universitarios  y de titulodel formulario
        $universidad= new Universidad($_POST["Login"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
        $tituloAcademico= new TituloAcademico($_POST["Login"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);

        //añade datos universitarios y titulo al usuario
        $usuario->altaUsuario();
        $universidad->AltaUniversidad();
        $tituloAcademico->AltaTituloAcademico();
        header("location: ../../Controller/UsuariosController.php?evento=listarUsuariosAdmin");
    }else{

        anadirMensaje("|ERROR| El usuario ya esta dado de alta","Intente otro login");
        header('location:../../View/Usuario/altaUsuarioAdmin.php');
    }
        break;

// registrar un usuario
    case 'registrarUsuario':
        if ($_POST["PasswordU"]!==$_POST["PasswordU2"]) {
            header("location: ../../View/errores.php?PassErr");
        }

        //registra el usuario en la bd
        $usuario = new Usuarios ($_POST["Login"], $_POST["PasswordU"], $_POST["NombreU"],$_POST["ApellidosU"],$_POST["Telefono"], $_POST["Mail"], $_POST["DNI"],$_POST["FechaNacimiento"], $_POST["TipoContrato"],$_POST["Centro"],$_POST["Departamento"],"U");

        //recoge los datos universitarios  y de titulodel formulario
        $universidad= new Universidad($_POST["Login"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
        $tituloAcademico= new TituloAcademico($_POST["Login"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);

        //añade datos universitarios y titulo al usuario
        $usuario->altaUsuario();
        $universidad->AltaUniversidad();
        $tituloAcademico->AltaTituloAcademico();
      header("location: ../../index.php");
    break;

// dar de alta un nuevo titulo academico
    case 'altaTituloAcademico':
        $LoginU= $_POST["LoginU"];
        $tituloAcademico= new TituloAcademico($_POST["LoginU"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);
        $tituloAcademico->AltaTituloAcademico();
        header("location: ../../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");
        break;

// dar de alta una nueva universidad
    case 'altaUniversidad':
        $LoginU= $_POST["LoginU"];
        $universidad= new Universidad($_POST["LoginU"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
        $universidad->AltaUniversidad();
        header("location: ../../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");
        break;

//cerrar session
    case 'logOut':

          session_unset();
          session_destroy();

          header("location:../../index.php");
      break;

//loguear usuario
  case 'Login':
     $LoginU= $_POST["LoginU"];
     $PasswordU= $_POST["PasswordU"];
    $usuario = new Usuarios( $LoginU,$PasswordU,"","","","","","","","","","");
     $usuario->login();

    if (isset( $_SESSION["Usuario"])) {


        header("location: ../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");
    } else {

        header("location: ../../index.php");
    }

      break;

//consultar perfil
    case 'consultarUsuario':

        //conuslta datos del usuario
        $Login=$_REQUEST["LoginU"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuario = $Usuario->consultarUsuario($Login);

        $consulta = array();
        while($row = mysql_fetch_array($consultarUsuario)){
            array_push($consulta, $row);
        }

		//lista datos de titulos del usuario
        $consultarTitulo = $Usuario->ConsultarTitulos($Login);

        $consultaUT = array();
        while($row3 = mysql_fetch_array($consultarTitulo)){
            array_push($consultaUT, $row3);
        }
        //lista datos universidades del usuario

        $consultarUniversidad = $Usuario->ConsultarUniversidades($Login);

        $consultaUA = array();
        while($row2 = mysql_fetch_array($consultarUniversidad)){
            array_push($consultaUA, $row2);
        }

        $_SESSION["ConsultarU"] = $consulta;
        $_SESSION["ConsultaUT"] = $consultaUT;
        $_SESSION["ConsultaUA"] = $consultaUA;

		header("location: ../../View/Usuario/consultarUsuario.php");
    break;
    //consultar detalle del usuario
    case 'consultarDetalleUsuario':

        //conuslta datos del usuario
        $Login=$_REQUEST["LoginU"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuario = $Usuario->consultarUsuario($Login);

        $consulta = array();
        while($row = mysql_fetch_array($consultarUsuario)){
            array_push($consulta, $row);
        }

        //lista datos de titulos del usuario
        $consultarTitulo = $Usuario->ConsultarTitulos($Login);

        $consultaUT = array();
        while($row3 = mysql_fetch_array($consultarTitulo)){
            array_push($consultaUT, $row3);
        }
        //lista datos universidades del usuario

        $consultarUniversidad = $Usuario->ConsultarUniversidades($Login);

        $consultaUA = array();
        while($row2 = mysql_fetch_array($consultarUniversidad)){
            array_push($consultaUA, $row2);
        }

        $_SESSION["ConsultarU"] = $consulta;
        $_SESSION["ConsultaUT"] = $consultaUT;
        $_SESSION["ConsultaUA"] = $consultaUA;

        header("location: ../../View/Usuario/consultarDetalleUsuario.php");
        break;

//consultar titulo academico
    case 'consultarTituloAcademico':
        $LoginU=$_REQUEST["LoginU"];
        $NombreTitulo=$_REQUEST["NombreTitulo"];
        $titulo = new TituloAcademico("","","","");
        $consulta= $titulo->ConsultaTituloAcademico($LoginU,$NombreTitulo);


        $consultaTitulo = array();
        while($row2 = mysql_fetch_array($consulta)){
            array_push($consultaTitulo, $row2);
        }

        $_SESSION["ConsultarTitulo"] = $consultaTitulo;

        header("location: ../../View/TituloAcademico/modificarTituloAcademico.php");
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

        $usuario = new Usuarios($LoginU, $NombreU, $ApellidosU, $Telefono, $Mail, $DNI,$FechaNacimiento, $TipoContrato,$Centro,$Departamento);
        $usuario->ModificarUsuario($LoginU);


        header("location: ../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");

        break;

//modificar titulo academico
    case 'modificarTituloAcademico':

        $LoginU = $_POST['LoginU'];
        $NombreTitulo = $_POST['NombreTitulo'];
        $FechaTitulo = $_POST['FechaTitulo'];
        $CentroTitulo = $_POST['CentroTitulo'];

        $titulo = new TituloAcademico($LoginU, $NombreTitulo, $FechaTitulo, $CentroTitulo);
        $titulo->ModificarTituloAcademico($LoginU,$NombreTitulo);


        header("location: ../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");

        break;
//lista de usuarios para el administrador
    case 'listarUsuariosAdmin':
        $lista = new Usuarios("","","","","","","","","","","","");
        //todos los usuarios
        $listaUsuarios = $lista->ListarUsuarios();
        $listaResultado = array();
        while($row = mysql_fetch_array($listaUsuarios)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        header("location: ../../View/Usuario/listarUsuariosAdmin.php");
        break;
//lista de usuarios para el usuario
    case 'listarUsuarios':
        $lista = new Usuarios("","","","","","","","","","","","");
        //todos los usuarios
        $listaUsuarios = $lista->ListarUsuarios();
        $listaResultado = array();
        while($row = mysql_fetch_array($listaUsuarios)){
            array_push($listaResultado, $row);
        }
        $_SESSION["listarUsuarios"] = $listaResultado;
        header("location: ../../View/Usuario/listarUsuarios.php");
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
        header("location: ../../Controller/UsuariosController.php?evento=listarUsuarios");

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
        header("location: ../../Controller/UsuariosController.php?evento=logOut");

        break;
  default:
    # code...
    echo "ACCION NO REGISTRADA";
    break;
}

?>
