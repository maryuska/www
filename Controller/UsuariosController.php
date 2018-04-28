<?php
// Controlador de Usuarios

require_once '../Model/Usuarios.php';
require_once '../Model/Universidad.php';
require_once '../Model/TituloAcademico.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    case 'registrarUsuario':

        if ($_POST["PasswordU"]!==$_POST["PasswordU2"]) {
            header("location: ../../View/errores.php?PassErr");
        }

        //registra el usuario en la bd
        $usuario = new Usuarios ($_POST["Login"], $_POST["PasswordU"], $_POST["NombreU"],$_POST["ApellidosU"],$_POST["Telefono"], $_POST["Mail"], $_POST["DNI"],$_POST["FechaNacimiento"], $_POST["TipoContrato"],$_POST["Centro"],$_POST["Departamento"]);

        //recoge los datos universitarios  y de titulodel formulario
        $universidad= new Universidad($_POST["Login"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
        $tituloAcademico= new TituloAcademico($_POST["Login"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);


        //añade datos universitarios y titulo al usuario
        $usuario->altaUsuario();
        $universidad->AltaUniversidad();
        $tituloAcademico->AltaTituloAcademico();


      header("location: ../../View/home.php");
    break;


    case 'altaTituloAcademico':
        $LoginU= $_POST["LoginU"];
        $tituloAcademico= new TituloAcademico($_POST["LoginU"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);
        $tituloAcademico->AltaTituloAcademico();
        header("location: ../../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");
        break;

    case 'altaUniversidad':
        $LoginU= $_POST["LoginU"];
        $universidad= new Universidad($_POST["LoginU"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
        $universidad->AltaUniversidad();
        header("location: ../../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");
        break;

    case 'logOut':

          session_unset();
          session_destroy();

          header("location:../../View/home.php");
      break;

  case 'Login':
     $LoginU= $_POST["LoginU"];
     $PasswordU= $_POST["PasswordU"];
    $usuario = new Usuarios( $LoginU,$PasswordU,"","","","","","","");
     $usuario->login();

    if (isset( $_SESSION["Usuario"])) {


        header("location: ../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");
    } else {

        header("location: ../../View/home.php");
    }


      break;


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



    case 'listarUsuarios':

        $lista = new Usuarios("","","","","","","","","","","");
        $lista->ListarUsuarios();
        header("location: ../../View/Usuario/listarUsuario.php");
        break;

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

        //header("location: UsuariosController.php?evento=consultarUsuario&loginU=$LoginU");

        header("location: ../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");

        break;


    case 'modificarTituloAcademico':

        $LoginU = $_POST['LoginU'];
        $NombreTitulo = $_POST['NombreTitulo'];
        $FechaTitulo = $_POST['FechaTitulo'];
        $CentroTitulo = $_POST['CentroTitulo'];

        $titulo = new TituloAcademico($LoginU, $NombreTitulo, $FechaTitulo, $CentroTitulo);
        $titulo->ModificarTituloAcademico($LoginU);


        header("location: ../Controller/UsuariosController.php?evento=consultarUsuario&LoginU=$LoginU");

        break;

  default:
    # code...
    echo "ACCION NO REGISTRADA";
    break;
}

?>
